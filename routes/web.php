<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProductController as PublicProductController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\OrderController as PublicOrderController;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/menu', [PublicProductController::class, 'index'])->name('menu');
Route::get('/menu/{product}', [PublicProductController::class, 'show'])->name('product.detail');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'storeContact'])->name('contact.store');
Route::get('/testimonial', [ContactController::class, 'testimonial'])->name('testimonial');
Route::post('/testimonial', [ContactController::class, 'storeTestimonial'])->name('testimonial.store');

Route::post('/payment-callback', [PublicOrderController::class, 'paymentCallback'])->name('payment.callback');

Route::middleware(['auth', 'check.profile'])->group(function () {
    Route::get('/checkout', [PublicOrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [PublicOrderController::class, 'store'])->name('order.store');


    Route::get('/orders', [PublicOrderController::class, 'index'])->name('orders.index');


    Route::get('/orders/success/{order}', [PublicOrderController::class, 'success'])->name('orders.success');


    Route::get('/order/{order}/status', [PublicOrderController::class, 'paymentStatus'])->name('order.status');
});


Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('products', ProductController::class, ['as' => 'admin']);
        Route::resource('categories', CategoryController::class, ['as' => 'admin']);
        Route::resource('faqs', FaqController::class, ['as' => 'admin']);

        Route::get('/testimoni', [TestimoniController::class, 'index'])->name('admin.testimoni.index');
        Route::post('/testimoni/{testimoni}/approve', [TestimoniController::class, 'approve'])->name('admin.testimoni.approve');
        Route::delete('/testimoni/{testimoni}/reject', [TestimoniController::class, 'reject'])->name('admin.testimoni.reject');

        Route::get('/contact', [AdminContactController::class, 'index'])->name('admin.contact.index');
        Route::get('/contact/{message}', [AdminContactController::class, 'show'])->name('admin.contact.show');
        Route::delete('/contact/{message}', [AdminContactController::class, 'destroy'])->name('admin.contact.destroy');

        Route::resource('orders', AdminOrderController::class, ['as' => 'admin']);
        Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    });
});

Route::resource('admins', AdminController::class, ['as' => 'admin']);

Route::prefix('api/v1')->group(function () {
    Route::get('/products', [\App\Http\Controllers\Public\ProductController::class, 'apiIndex']);
    Route::get('/products/{product}', [\App\Http\Controllers\Public\ProductController::class, 'apiShow']);
    Route::get('/categories', function () {
        return response()->json(\App\Models\Category::all());
    });
    Route::get('/testimonials', function () {
        return response()->json(\App\Models\Testimoni::where('is_approved', true)->get());
    });
    Route::get('/faqs', function () {
        return response()->json(\App\Models\Faq::orderBy('order')->get());
    });
    Route::get('/search', [\App\Http\Controllers\Public\ProductController::class, 'apiSearch']);
});
