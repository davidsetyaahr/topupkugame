<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;


class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Frontend/Home', [
            'title' => 'Home',
            'product' => Product::with('company')->get(),
        ]);
    }
}
