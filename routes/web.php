<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\SellController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/produk', ProductController::class);
    Route::resource('/pemesanan', SellController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
