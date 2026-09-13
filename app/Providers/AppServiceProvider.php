<?php

namespace App\Providers;

use App\Models\ContactMessage;
use App\Models\Order;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Midtrans\Config;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        View::composer('layouts.admin', function ($view) {
            $view->with('adminNoticeCount', Cache::remember('admin.notice_count', 60, function () {
                return Order::where('order_status', 'pending')->count()
                    + ContactMessage::where('is_read', false)->count();
            }));
        });
    }
}