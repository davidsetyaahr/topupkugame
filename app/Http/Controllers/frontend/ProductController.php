<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class ProductController extends Controller
{
    public function detail($url)
    {
        return Inertia::render('Frontend/Product/Detail', [
            'title' => 'Detail',
            'product' => Product::with('company')->with('voucher')->where('url',$url)->firstOrFail(),
        ]);
    }
}
