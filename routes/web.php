<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProductController as PublicProductController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\OrderController as PublicOrderController;
use App\Http\Controllers\Public\TestimonialController;
use App\Http\Controllers\Public\ApiController;

require __DIR__ . '/auth.php';

// ── Customer landing after auth (Breeze redirects here) ──────────────────────
Route::get('/dashboard', fn () => redirect()->route('home'))
    ->middleware('auth')
    ->name('dashboard');

// ── Public storefront ────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/menu', [PublicProductController::class, 'index'])->name('menu');
Route::get('/menu/{product}', [PublicProductController::class, 'show'])->name('product.detail');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'storeContact'])->name('contact.store');
Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial');
Route::post('/testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');

// Midtrans server-to-server callback (payload verified by signature in the service layer)
Route::post('/payment-callback', [PublicOrderController::class, 'paymentCallback'])->name('payment.callback');

// ── Customer account & purchasing flow ───────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Order viewing: cukup login, tidak perlu profil lengkap
    Route::get('/orders', [PublicOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order:order_number}', [PublicOrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/success/{order:order_number}', [PublicOrderController::class, 'success'])->name('orders.success');
    Route::get('/order/{order:order_number}/status', [PublicOrderController::class, 'paymentStatus'])->name('order.status');
});

Route::middleware(['auth', 'check.profile'])->group(function () {
    Route::get('/checkout', [PublicOrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [PublicOrderController::class, 'store'])->name('order.store');
});

// ── Admin panel ──────────────────────────────────────────────────────────────
Route::prefix('admin')->as('admin.')->group(function () {
    // Public auth pages inside the admin area
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Authenticated admin area
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/search', [DashboardController::class, 'search'])->name('dashboard.search');

        // Resource CRUD (orders: only read/destroy + custom status action)
        Route::resource('users', UserController::class);
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('faqs', FaqController::class);
        Route::post('/faqs/{faq}/move/{direction}', [FaqController::class, 'move'])->name('faqs.move');
        Route::resource('banners', BannerController::class);
        Route::resource('galleries', GalleryController::class);
        Route::post('/galleries/{gallery}/move/{direction}', [GalleryController::class, 'move'])->name('galleries.move');
        Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'destroy']);
        Route::resource('admins', AdminController::class);

        // Testimonials moderation
        Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');
        Route::post('/testimoni/{testimoni}/approve', [TestimoniController::class, 'approve'])->name('testimoni.approve');
        Route::delete('/testimoni/{testimoni}/reject', [TestimoniController::class, 'reject'])->name('testimoni.reject');

        // Contact inbox
        Route::get('/contact', [AdminContactController::class, 'index'])->name('contact.index');
        Route::get('/contact/{message}', [AdminContactController::class, 'show'])->name('contact.show');
        Route::delete('/contact/{message}', [AdminContactController::class, 'destroy'])->name('contact.destroy');

        // Custom order action
        Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });
});

// ── Read-only API for external/headless consumers ────────────────────────────
Route::prefix('api/v1')->group(function () {
    Route::get('/products', [ApiController::class, 'products']);
    Route::get('/products/{product}', [ApiController::class, 'product']);
    Route::get('/categories', [ApiController::class, 'categories']);
    Route::get('/testimonials', [ApiController::class, 'testimonials']);
    Route::get('/faqs', [ApiController::class, 'faqs']);
    Route::get('/search', [ApiController::class, 'search']);
});