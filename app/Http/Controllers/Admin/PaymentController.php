<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentHistory;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function index()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $payments = PaymentHistory::latest()->paginate(20);
        return view('admin.payments.index', compact('payments'));
    }

    public function checkStatus(Order $order)
    {
        $result = $this->midtransService->checkStatus($order);
        
        if ($result['success']) {
            $order->payment_status = $this->mapStatus($result['transaction_status']);
            $order->save();
        }

        return back()->with('success', 'Payment status updated');
    }

    public function approveManual(Order $order)
    {
        $result = $this->midtransService->approveTransaction($order);
        
        if ($result['success']) {
            return back()->with('success', 'Payment approved');
        }

        return back()->with('error', 'Failed to approve payment');
    }

    public function refund(Order $order, Request $request)
    {
        $request->validate([
            'refund_amount' => 'required|numeric|min:1',
            'reason' => 'nullable|string'
        ]);

        \Midtrans\Transaction::refund(
            $order->order_number,
            (int)$request->refund_amount
        );

        $order->payment_status = 'refunded';
        $order->save();

        return back()->with('success', 'Refund processed successfully');
    }

    private function mapStatus($transactionStatus)
    {
        return match($transactionStatus) {
            'capture', 'settlement' => 'completed',
            'pending' => 'pending',
            'deny', 'expire', 'cancel' => 'failed',
            default => 'pending'
        };
    }
}