<?php

namespace App\Services;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction(Order $order)
    {
        $items = [];
        
        foreach ($order->items as $item) {
            $items[] = [
                'id' => $item->product_id,
                'price' => (int)$item->price,
                'quantity' => $item->quantity,
                'name' => $item->product->name,
            ];
        }

        $payload = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int)$order->total_amount,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'email' => $order->customer_email,
                'phone' => $order->customer_phone,
                'billing_address' => [
                    'address' => $order->customer_address,
                ],
            ],
            'item_details' => $items,
        ];

        try {
            $snapToken = Snap::getSnapToken($payload);
            return [
                'success' => true,
                'snap_token' => $snapToken
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function handleCallback($notification)
    {
        $orderId = $notification['order_id'] ?? null;
        $transactionStatus = $notification['transaction_status'] ?? null;
        $statusCode = $notification['status_code'] ?? null;
        $grossAmount = $notification['gross_amount'] ?? null;
        $signatureKey = $notification['signature_key'] ?? null;
        $transactionId = $notification['transaction_id'] ?? null;
        $fraudStatus = $notification['fraud_status'] ?? null;

        if (!$orderId || !$transactionStatus || !$statusCode || !$grossAmount || !$signatureKey) {
            return ['success' => false, 'message' => 'Incomplete notification', 'http_code' => 400];
        }

        $order = Order::where('order_number', $orderId)->first();

        if (!$order) {
            return ['success' => false, 'message' => 'Order not found', 'http_code' => 404];
        }

        $expectedSignature = hash(
            'sha512',
            $orderId . $statusCode . $grossAmount . config('midtrans.server_key')
        );

        if (!hash_equals($expectedSignature, $signatureKey)) {
            Log::warning('Midtrans callback ditolak: signature tidak valid untuk order ' . $orderId);
            return ['success' => false, 'message' => 'Invalid signature', 'http_code' => 403];
        }

        if (abs((float) $grossAmount - (float) $order->total_amount) > 0.001) {
            Log::warning('Midtrans callback ditolak: nominal tidak sesuai untuk order ' . $orderId);
            return ['success' => false, 'message' => 'Amount mismatch', 'http_code' => 400];
        }

        if ($transactionId) {
            $existing = PaymentHistory::where('transaction_id', $transactionId)->first();
            if ($existing) {
                return ['success' => true, 'message' => 'Payment already processed', 'http_code' => 200];
            }
        }

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $order->payment_status = 'pending';
            } else if ($fraudStatus == 'accept') {
                $order->payment_status = 'completed';
            }
        } else if ($transactionStatus == 'settlement') {
            $order->payment_status = 'completed';
        } else if ($transactionStatus == 'pending') {
            $order->payment_status = 'pending';
        } else if ($transactionStatus == 'deny') {
            $order->payment_status = 'failed';
        } else if ($transactionStatus == 'expire') {
            $order->payment_status = 'failed';
        } else if ($transactionStatus == 'cancel') {
            $order->payment_status = 'failed';
        }

        $order->midtrans_transaction_id = $transactionId;
        $order->payment_method = $notification['payment_type'] ?? null;

        if ($order->payment_status === 'completed' && $order->order_status === 'pending') {
            $order->order_status = 'processing';
        }

        $order->save();

        if ($transactionId) {
            PaymentHistory::create([
                'order_id' => $order->id,
                'transaction_id' => $transactionId,
                'payment_method' => $notification['payment_type'] ?? 'unknown',
                'status' => $order->payment_status,
                'amount' => (float) $grossAmount,
                'metadata' => $notification,
            ]);
        }

        return ['success' => true, 'message' => 'Payment status updated', 'http_code' => 200];
    }
}