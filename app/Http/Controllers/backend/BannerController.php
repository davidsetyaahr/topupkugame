<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Backend/Banner/Index', [
            'title' => 'Banner',
            'data' => Banner::where('url', 'like', "%" . $request->key . "%")->get(),
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
            'image_banner'  => '',
            'url'  => '',
        );
        return Inertia::render('Backend/Banner/Form', [
            'title' => 'Tambah Banner',
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'url'   => 'required',
            'image_banner'   => 'required|mimes:jpeg,png,jpg',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $document = $request->image_banner;
                $document->storeAs('master-banner', $document->hashName());
                $model = new Banner();
                $model->banner = $document->hashName();
                $model->url = str_replace(' ', '-', strtolower($request->url));
                $model->save();
            });

            return redirect()->route('banner.index')->with('message', 'Data berhasil ditambahkan.');
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
        $banner = Banner::find($id);
        $data = array(
            'page'  => 'edit',
            'id'    => $id,
            'image_banner'  => '',
            'url'  => str_replace('-', ' ', $banner->url),
        );
        return Inertia::render('Backend/Banner/Form', [
            'title' => 'Edit Banner',
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'url'   => 'required',
        ]);
        // if ($request->banner) {
        //     'banner'   => 'required|mimes:jpeg,png,jpg',
        // }
        try {
            DB::transaction(function () use ($request, $id) {
                if ($request->image_banner) {
                    $document = $request->image_banner;
                    $document->storeAs('master-banner', $document->hashName());
                }
                $model = Banner::find($id);
                if ($request->image_banner) {
                    $model->banner = $document->hashName();
                }
                $model->url = str_replace(' ', '-', strtolower($request->url));
                $model->save();
            });

            return redirect()->route('banner.index')->with('message', 'Data berhasil ditambahkan.');
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
            Banner::find($id)->delete();

            return redirect()->route('banner.index')->with('message', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e);
        }
    }
}
