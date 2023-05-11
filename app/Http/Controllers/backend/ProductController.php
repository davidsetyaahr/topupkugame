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
            'voucher'  => [],
            'amount'  => [],
            'margin'  => [],
            'oldvoucher'  => [],
            'oldidvoucher'  => [],
            'oldamount'  => [],
            'oldmargin'  => [],
        );
        $voucher = Voucher::where('product_id', $id)->get();
        foreach ($voucher as $key => $value) {
            array_push($data['voucher'], $value->title);
            array_push($data['amount'], $value->amount);
            array_push($data['margin'], $value->margin);
            array_push($data['oldidvoucher'], $value->id);
            array_push($data['oldvoucher'], $value->title);
            array_push($data['oldamount'], $value->amount);
            array_push($data['oldmargin'], $value->margin);
        }
        return Inertia::render('Backend/Product/Form', [
            'title' => 'Edit Produk',
            'company' => Company::all(),
            'data' => $data,
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
            'voucher.*'   => 'required',
            'amount.*'   => 'required',
            'margin.*'   => 'required',
        ]);
        // if ($request->banner) {
        //     'banner'   => 'required|mimes:jpeg,png,jpg',
        // }
        // if ($request->top_banner) {
        //     'top_banner'   => 'required|mimes:jpeg,png,jpg',
        // }
        try {
            DB::transaction(function () use ($request, $id) {
                foreach ($request->oldidvoucher as $keyOld => $valueOld) {
                    $oldVoucher = Voucher::find($valueOld);
                    if ($oldVoucher != null) {
                        $oldVoucher->title = $request->voucher[$keyOld];
                        $oldVoucher->amount = $request->amount[$keyOld];
                        $oldVoucher->margin = $request->margin[$keyOld];
                        $oldVoucher->save();
                    } else {
                        $voucher = new Voucher;
                        $voucher->title = $request->voucher[$keyOld];
                        $voucher->amount = $request->amount[$keyOld];
                        $voucher->margin = $request->margin[$keyOld];
                        $voucher->save();
                    }
                }
                // if ($request->banner) {
                //     $document = $request->banner;
                //     $document->storeAs('banner', $document->hashName());
                // }
                // if ($request->top_banner) {
                //     $documentTop = $request->top_banner;
                //     $documentTop->storeAs('top-banner', $documentTop->hashName());
                // }
                // $model = Product::find($id);
                // $model->company_id = $request->company_id;
                // $model->name = $request->name;
                // if ($request->banner) {
                //     $model->banner = $document->hashName();
                // }
                // if ($request->top_banner) {
                //     $model->top_banner = $documentTop->hashName();
                // }
                // $model->description = $request->desc;
                // $model->url = str_replace(' ', '-', strtolower($request->name));
                // $model->save();

                // // insert voucher
                // foreach ($request->voucher as $key => $value) {
                //     $modelVouher = new Voucher;
                //     $modelVouher->product_id  = $model->id;
                //     $modelVouher->title = $value;
                //     $modelVouher->amount = $request->amount[$key];
                //     $modelVouher->margin = $request->margin[$key];
                //     $modelVouher->save();
                // }
            });
            return Inertia::location(route('produk.index'));
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
}
