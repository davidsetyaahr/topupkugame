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
        ]);
        try {
            DB::transaction(function () use ($request) {
                $document = $request->banner;
                $document->storeAs('banner', $document->hashName());
                $documentTop = $request->top_banner;
                $documentTop->storeAs('top-banner', $documentTop->hashName());
                $model = new Product();
                $model->company_id = $request->company_id['key'] + 1;
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

            return redirect()->route('produk.index')->with('message', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
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
        );
        $voucher = Voucher::where('product_id', $id)->get();
        foreach ($voucher as $key => $value) {
            array_push($data['voucher'], $value->title);
            array_push($data['amount'], $value->amount);
            array_push($data['margin'], $value->margin);
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
                Voucher::where('product_id', $id)->delete();
                if ($request->banner) {
                    $document = $request->banner;
                    $document->storeAs('banner', $document->hashName());
                }
                if ($request->top_banner) {
                    $documentTop = $request->top_banner;
                    $documentTop->storeAs('top-banner', $documentTop->hashName());
                }
                $model = Product::find($id);
                $model->company_id = $request->company_id['key'] + 1;
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

            return redirect()->route('produk.index')->with('message', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
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
            return redirect()->route('produk.index')->with('message', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }
}
