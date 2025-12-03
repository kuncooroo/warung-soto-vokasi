<?php

namespace App\Services;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        Config::$is3ds = env('MIDTRANS_IS_3DS', true);
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
        $orderId = $notification['order_id'];
        $transactionStatus = $notification['transaction_status'];
        $fraudStatus = $notification['fraud_status'] ?? null;

        $order = Order::where('order_number', $orderId)->first();

        if (!$order) {
            return ['success' => false, 'message' => 'Order not found'];
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

        $order->midtrans_transaction_id = $notification['transaction_id'];
        $order->payment_method = $notification['payment_type'] ?? null;
        $order->save();

        return ['success' => true, 'message' => 'Payment status updated'];
    }
}