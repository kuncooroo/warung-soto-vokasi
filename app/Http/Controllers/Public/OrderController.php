<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\MidtransService;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use App\Mail\PaymentSuccessMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', auth()->id())
            ->orWhere(function ($q) {
                $q->whereNull('user_id')->where('customer_email', auth()->user()->email);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('public.orders.index', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {
        abort_unless($this->belongsToUser($order), 403);

        return view('public.orders.show', [
            'order' => $order->load('items.product'),
        ]);
    }

    public function success(Order $order)
    {
        abort_unless($this->belongsToUser($order), 403);

        return view('public.success', compact('order'));
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
            $product = Product::where('is_active', true)->find($item['id']);

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

    public function store(StoreOrderRequest $request)
    {
        $items = json_decode($request->items, true);

        if (!is_array($items) || count($items) === 0 || count($items) > 50) {
            return response()->json(['success' => false, 'message' => 'Keranjang kosong atau terlalu banyak item'], 422);
        }

        $resolvedItems = [];
        $totalAmount = 0;

        foreach ($items as $item) {
            $product = Product::where('is_active', true)->find($item['product_id'] ?? null);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found'], 404);
            }

            $quantity = (int) ($item['quantity'] ?? 0);
            if ($quantity < 1 || $quantity > 99) {
                return response()->json(['success' => false, 'message' => 'Quantity tidak valid'], 422);
            }

            if ($product->stock !== null && $quantity > $product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => "Stok {$product->name} tidak mencukupi (sisa {$product->stock})"
                ], 422);
            }

            $resolvedItems[] = [
                'product' => $product,
                'quantity' => $quantity,
            ];

            $totalAmount += $product->price * $quantity;
        }

        $order = DB::transaction(function () use ($request, $resolvedItems, $totalAmount) {
            $order = new Order();
            $order->generateOrderNumber();
            $order->user_id = auth()->id();
            $order->customer_name = $request->customer_name;
            $order->customer_email = $request->customer_email;
            $order->customer_phone = $request->customer_phone;
            $order->customer_address = $request->customer_address;
            $order->total_amount = $totalAmount;
            $order->notes = $request->notes;
            $order->payment_status = 'pending';
            $order->save();

            foreach ($resolvedItems as $item) {
                $product = $item['product'];
                $quantity = $item['quantity'];

                if ($product->stock !== null) {
                    $product->decrement('stock', $quantity);
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $product->price * $quantity
                ]);
            }

            return $order;
        });

        try {
            Mail::to($order->customer_email)->queue(new OrderConfirmationMail($order));
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email konfirmasi order: ' . $e->getMessage());
        }

        try {
            Notification::route('mail', config('mail.from.address'))
                ->notify(new NewOrderNotification($order));
        } catch (\Exception $e) {
            Log::error('Gagal mengirim notifikasi admin: ' . $e->getMessage());
        }

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

        $orderId = $notification['order_id'] ?? null;
        $httpCode = $result['http_code'] ?? (($result['success'] ?? false) ? 200 : 400);

        if ($orderId && ($result['success'] ?? false)) {
            Log::info('Callback received for Order ID: ' . $orderId);

            $order = Order::where('order_number', $orderId)->first();

            if ($order && $order->payment_status == 'completed') {
                try {
                    Mail::to($order->customer_email)->queue(new PaymentSuccessMail($order));
                    Log::info('Email sukses bayar dikirim ke: ' . $order->customer_email);
                } catch (\Exception $e) {
                    Log::error('Gagal mengirim email sukses bayar: ' . $e->getMessage());
                }
            } else {
                Log::warning('Email tidak dikirim. Status order: ' . ($order ? $order->payment_status : 'Order not found'));
            }
        }

        return response()->json($result, $httpCode);
    }

    public function paymentStatus(Order $order)
    {
        abort_unless($this->belongsToUser($order), 403);

        return response()->json([
            'success' => true,
            'payment_status' => $order->payment_status,
            'refreshed_at' => now()->toIso8601String(),
        ]);
    }

    private function belongsToUser(Order $order): bool
    {
        return $order->user_id === auth()->id()
            || $order->customer_email === auth()->user()->email;
    }
}