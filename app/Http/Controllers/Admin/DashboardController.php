<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Testimoni;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $totalProducts = Product::count();
        $totalTestimoni = Testimoni::count();
        $totalMessages = ContactMessage::where('is_read', false)->count();

        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'totalTestimoni' => $totalTestimoni,
            'totalMessages' => $totalMessages
        ]);
    }
}