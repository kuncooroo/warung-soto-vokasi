<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private function checkLogin()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }
    }

    public function index()
    {
        $this->checkLogin();
        $orders = Order::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->checkLogin();
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,completed,failed'
        ]);

        $order->payment_status = $request->payment_status;
        $order->save();

        return back()->with('success', 'Order status updated');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted');
    }
}