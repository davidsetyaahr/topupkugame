<?php

use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\PaymentMethodController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\SellController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\frontend\AuthController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\OrderController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/details/{url}', [App\Http\Controllers\frontend\ProductController::class, 'detail']);
Route::post('/order', [OrderController::class, 'store']);
Route::post('/proof-of-payment', [OrderController::class, 'proofOfPayment'])->name('proof-of-payment');
Route::get('/order-success/{url}', [OrderController::class, 'orderSuccess']);
Route::get('/upload-success/{url}', [OrderController::class, 'uploadSuccess']);
Route::get('/cek-pesanan', [OrderController::class, 'cekOrder']);
Route::get('/metode-pembayaran', [OrderController::class, 'paymentMethod']);
Route::prefix('auth-customer')->group(
    function () {
        Route::get('/login', [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'register']);
        Route::post('/store-register', [AuthController::class, 'storeRegister']);
        Route::post('/store-login', [AuthController::class, 'storeLogin']);
        Route::get('/check-login', [AuthController::class, 'checkSession']);
        Route::get('/logout', [AuthController::class, 'logout']);
    }
);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('voucher')->group(function () {
        Route::post('/store', [ProductController::class, 'storeVoucher']);
        Route::get('/{id}', [ProductController::class, 'editVoucher']);
        Route::post('/update', [ProductController::class, 'updateVoucher']);
        Route::get('/delete/{id}', [ProductController::class, 'destroyVoucher']);
    });
    Route::resource('/produk', ProductController::class);
    Route::prefix('pemesanan')->group(function () {
        // Route::resource('/', SellController::class);
        Route::get('/', [SellController::class, 'index']);
        Route::get('/show/{id}', [SellController::class, 'show']);
        Route::get('/acc/{id}', [SellController::class, 'acc']);
        Route::get('/reject/{id}', [SellController::class, 'reject']);
        Route::get('/rekap', [SellController::class, 'rekap']);
    });
    Route::resource('/banner', BannerController::class);
    Route::resource('/payment-method', PaymentMethodController::class);
    Route::resource('/customer', CustomerController::class);
    Route::resource('/setting', SettingController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
