<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function checkout(Request $request)
    {
        $cartData = json_decode($request->cart_data, true);

        if (!$cartData) {
            return redirect()->route('menu')->with('error', 'Keranjang kosong!');
        }

        $products = [];
        $totalAmount = 0;

        foreach ($cartData as $item) {
            $product = Product::find($item['id']);

            if ($product) {
                $products[] = [
                    'product' => $product,
                    'qty' => $item['qty'],
                    'subtotal' => $product->price * $item['qty']
                ];

                $totalAmount += $product->price * $item['qty'];
            }
        }

        return view('public.checkout', [
            'items' => $products,
            'total' => $totalAmount,
            'user' => auth()->user()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
            'items' => 'required|json',
            'notes' => 'nullable|string'
        ]);

        $items = json_decode($request->items, true);
        $totalAmount = 0;

        // Validasi items dan hitung total
        foreach ($items as $item) {
            $product = Product::find($item['product_id']);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found'], 404);
            }
            $totalAmount += $product->price * $item['quantity'];
        }

        // Create order
        $order = new Order();
        $order->generateOrderNumber();
        $order->customer_name = $request->customer_name;
        $order->customer_email = $request->customer_email;
        $order->customer_phone = $request->customer_phone;
        $order->customer_address = $request->customer_address;
        $order->total_amount = $totalAmount;
        $order->notes = $request->notes;
        $order->save();

        // Create order items
        foreach ($items as $item) {
            $product = Product::find($item['product_id']);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
                'subtotal' => $product->price * $item['quantity']
            ]);
        }

        // Get Midtrans token
        $midtransResponse = $this->midtransService->createTransaction($order);

        if (!$midtransResponse['success']) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'snap_token' => $midtransResponse['snap_token'],
            'order_id' => $order->id
        ]);
    }

    public function paymentCallback(Request $request)
    {
        $notification = $request->all();
        $result = $this->midtransService->handleCallback($notification);

        return response()->json($result);
    }

    public function paymentStatus($orderId)
    {
        $order = Order::findOrFail($orderId);

        return response()->json([
            'success' => true,
            'payment_status' => $order->payment_status,
            'order' => $order
        ]);
    }
}
