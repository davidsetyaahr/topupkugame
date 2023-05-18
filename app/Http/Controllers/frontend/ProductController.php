<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\PaymentMethod;

class ProductController extends Controller
{
    public function detail($url)
    {
        return Inertia::render('Frontend/Product/Detail', [
            'title' => 'Detail',
            'paymentMethod' => PaymentMethod::get(),
            'product' => Product::with('company')->with('voucher')->where('url',$url)->firstOrFail(),
        ]);
    }
}
