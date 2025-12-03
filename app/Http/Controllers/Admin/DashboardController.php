<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Testimoni;
use App\Models\ContactMessage;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        // Total Data
        $totalOrders       = Order::count();
        $todayOrders       = Order::whereDate('created_at', today())->count();
        $totalUsers        = User::count();
        $pendingPayments   = Order::where('payment_status', 'pending')->count();
        $totalProducts     = Product::count();
        $totalTestimoni    = Testimoni::count();
        $totalMessages     = ContactMessage::where('is_read', false)->count();

        // Total Revenue (yang sudah dibayar)
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');

        // Statistik 7 Hari Terakhir
        $dailyOrdersRaw = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
        ->where('created_at', '>=', now()->subDays(6))
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->pluck('total', 'date');

        // Isi hari kosong supaya 7 hari full
        $dailyOrders = collect();
        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i)->format('Y-m-d');
            $dailyOrders[$day] = $dailyOrdersRaw[$day] ?? 0;
        }

        // Statistik pendapatan 6 bulan terakhir
        $monthlyRevenueRaw = Order::where('payment_status', 'paid')
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
            'latestTransactions' => Order::latest()->take(7)->get(),
        ]);
    }
}
