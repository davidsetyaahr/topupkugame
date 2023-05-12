<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Voucher;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Backend/Product/Index', [
            'title' => 'Produk',
            'product' => Product::with('company', 'voucher')->where('name', 'like', "%" . $request->key . "%")->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = array(
            'page'  => 'create',
            'id'    => '',
            'name'  => '',
            'company_id'  => '',
            'banner'  => '',
            'top_banner'  => '',
            'desc'  => '',
            'voucher'  => [''],
            'amount'  => [''],
            'margin'  => [''],
        );
        return Inertia::render('Backend/Product/Form', [
            'title' => 'Tambah Produk',
            'company' => Company::all(),
            'data' => $data,
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
            'top_banner'   => 'required|mimes:jpeg,png,jpg',
            'desc'   => 'required',
            'voucher.*'   => 'required',
            'amount.*'   => 'required',
            'margin.*'   => 'required',
        ], [
            'required' => ':attribute harus diisi.'
        ], [
            'name' => 'Nama Produk',
            'company_id' => 'Company',
            'desc' => 'Deskripsi',
            'voucher.*' => 'Nama voucher',
            'amount.*' => 'Harga',
            'margin.*' => 'Keuntungan',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $document = $request->banner;
                $document->storeAs('banner', $document->hashName());
                $documentTop = $request->top_banner;
                $documentTop->storeAs('top-banner', $documentTop->hashName());
                $model = new Product();
                $model->company_id = $request->company_id;
                $model->name = $request->name;
                $model->banner = $document->hashName();
                $model->top_banner = $documentTop->hashName();
                $model->description = $request->desc;
                $model->url = str_replace(' ', '-', strtolower($request->name));
                $model->save();

                // insert voucher
                foreach ($request->voucher as $key => $value) {
                    $modelVouher = new Voucher;
                    $modelVouher->product_id  = $model->id;
                    $modelVouher->title = $value;
                    $modelVouher->amount = $request->amount[$key];
                    $modelVouher->margin = $request->margin[$key];
                    $modelVouher->save();
                }
            });
            return Inertia::location(route('produk.index'));
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e->getMessage());
        }
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
        $model = Product::find($id);
        $data = array(
            'page'  => 'edit',
            'id'    => $id,
            'name'  => $model->name,
            'company_id'  => $model->company_id,
            'banner'  => '',
            'top_banner'  => '',
            'desc'  => $model->description,
            'voucher'  => '',
            'amount'  => '',
            'margin'  => '',
        );
        $voucher = Voucher::where('product_id', $id)->get();
        return Inertia::render('Backend/Product/Edit', [
            'title' => 'Edit Produk',
            'company' => Company::all(),
            'data' => $data,
            'voucher' => $voucher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request->all();
        $request->validate([
            'name'   => 'required',
            'company_id'   => 'required',
            'desc'   => 'required',
        ], [
            'required' => ':attribute harus diisi.'
        ], [
            'name' => 'Nama Produk',
            'company_id' => 'Company',
            'desc' => 'Deskripsi',
        ]);
        // if ($request->banner) {
        //     'banner'   => 'required|mimes:jpeg,png,jpg',
        // }
        // if ($request->top_banner) {
        //     'top_banner'   => 'required|mimes:jpeg,png,jpg',
        // }
        try {
            DB::transaction(function () use ($request, $id) {
                if ($request->banner) {
                    $document = $request->banner;
                    $document->storeAs('banner', $document->hashName());
                }
                if ($request->top_banner) {
                    $documentTop = $request->top_banner;
                    $documentTop->storeAs('top-banner', $documentTop->hashName());
                }
                $model = Product::find($id);
                $model->company_id = $request->company_id;
                $model->name = $request->name;
                if ($request->banner) {
                    $model->banner = $document->hashName();
                }
                if ($request->top_banner) {
                    $model->top_banner = $documentTop->hashName();
                }
                $model->description = $request->desc;
                $model->url = str_replace(' ', '-', strtolower($request->name));
                $model->save();
            });
            return Inertia::location(route('produk.edit', $id));
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                Voucher::where('product_id', $id)->delete();
                $model = Product::find($id);
                $model->delete();
            });
            return Inertia::location(route('produk.index'));
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function storeVoucher(Request $request)
    {
        $request->validate([
            'voucher'   => 'required',
            'amount'   => 'required',
            'margin'   => 'required',
        ], [
            'required' => ':attribute harus diisi.'
        ], [
            'voucher' => 'Nama voucher',
            'amount' => 'Harga',
            'margin' => 'Keuntungan',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $model = new Voucher;
                $model->product_id  = $request->product_id;
                $model->title = $request->voucher;
                $model->amount = $request->amount;
                $model->margin = $request->margin;
                $model->save();
            });
            return Inertia::location(redirect()->back());
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function destroyVoucher(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $model = Voucher::find($id);
                $model->delete();
            });
            return Inertia::location(redirect()->back());
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function editVoucher(string $id)
    {
        try {
            $model = Voucher::find($id);
            return $model;
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function updateVoucher(Request $request)
    {
        $request->validate([
            'voucher'   => 'required',
            'amount'   => 'required',
            'margin'   => 'required',
        ], [
            'required' => ':attribute harus diisi.'
        ], [
            'voucher' => 'Nama voucher',
            'amount' => 'Harga',
            'margin' => 'Keuntungan',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $model = Voucher::find($request->id);
                $model->product_id  = $request->product_id;
                $model->title = $request->voucher;
                $model->amount = $request->amount;
                $model->margin = $request->margin;
                $model->save();
            });
            return Inertia::location(redirect()->back());
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }
}
