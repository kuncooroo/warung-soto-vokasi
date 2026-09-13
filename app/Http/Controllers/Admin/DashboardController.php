<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Testimoni;
use App\Models\ContactMessage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders       = Order::count();
        $todayOrders       = Order::whereDate('created_at', today())->count();
        $totalUsers        = User::count();
        $pendingPayments   = Order::where('payment_status', 'pending')->count();
        $totalProducts     = Product::count();
        $totalTestimoni    = Testimoni::count();
        $totalMessages     = ContactMessage::where('is_read', false)->count();

        $totalRevenue = Order::where('payment_status', 'completed')->sum('total_amount');

        $dailyOrdersRaw = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
        ->where('created_at', '>=', now()->subDays(6))
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->pluck('total', 'date');

        $dailyOrders = collect();
        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i)->format('Y-m-d');
            $dailyOrders[$day] = $dailyOrdersRaw[$day] ?? 0;
        }

        $monthlyRevenueRaw = Order::where('payment_status', 'completed')
        ->select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('SUM(total_amount) as total')
        )
        ->groupBy('month')
        ->orderBy('month', 'ASC')
        ->pluck('total', 'month');

        $monthlyRevenue = collect();
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('Y-m');
            $monthlyRevenue[$month] = $monthlyRevenueRaw[$month] ?? 0;
        }

        return view('admin.dashboard', [
            'dailyOrders'        => $dailyOrders,
            'monthlyRevenue'     => $monthlyRevenue,
            'totalUsers'         => $totalUsers,
            'todayOrders'        => $todayOrders,
            'pendingPayments'    => $pendingPayments,
            'totalOrders'        => $totalOrders,
            'totalRevenue'       => $totalRevenue,
            'totalProducts'      => $totalProducts,
            'totalTestimoni'     => $totalTestimoni,
            'totalMessages'      => $totalMessages,
            'latestTransactions' => Order::with('items')->latest()->take(7)->get(),
        ]);
    }

    public function search(Request $request)
    {
        $keyword = trim($request->query('search', ''));

        $products = collect();
        $users = collect();
        $orders = collect();

        if ($keyword !== '') {
            $products = Product::where('name', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%")
                ->get();

            $users = User::where('name', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%")
                ->get();

            $orders = Order::where('order_number', 'like', "%{$keyword}%")
                ->orWhere('customer_name', 'like', "%{$keyword}%")
                ->limit(20)
                ->get();
        }

        return view('admin.search_results', compact('keyword', 'products', 'users', 'orders'));
    }
}