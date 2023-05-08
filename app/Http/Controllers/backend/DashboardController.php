<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Sell;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Backend/Dashboard', [
            'title' => 'Dashboard',
            'countSellNew' => Sell::where('status','0')->count(),
            'countProduct' => Product::count(),
            'countProductSell' => Sell::where('status','1')->whereMonth('created_at',date('m'))->count(),
            'sumProductSell' => Sell::where('status','1')->whereMonth('created_at',date('m'))->sum('margin'),
        ]);
    }
}
