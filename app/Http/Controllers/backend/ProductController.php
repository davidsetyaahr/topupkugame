<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Voucher;
use App\Models\Product;
use App\Models\Company;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Backend/Product/Index', [
            'title' => 'Produk',
            'product' => Product::where('name','like',"%".$request->key."%")->get(),
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Backend/Product/Form', [
            'title' => 'Tambah Produk',
            'company' => Company::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'company_id'   => 'required',
            'banner'   => 'required|mimes:jpeg,png,jpg',
            'desc'   => 'required',
            'voucher.*'   => 'required',
            'description.*'   => 'required',
            'amount.*'   => 'required',
            'margin.*'   => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
