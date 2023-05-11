<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::first();
        $data = array(
            'page' => 'create',
            'id' => $setting->id,
            'facebook'  => $setting->facebook,
            'instagram'  => $setting->instagram,
            'twitter'  => $setting->twitter,
            'youtube'  => $setting->youtube,
            'whatsapp'  => $setting->whatsapp,
            'tiktok'  => $setting->tiktok,
        );
        return Inertia::render('Backend/Setting/Form', [
            'title' => 'Company Setting',
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'facebook'   => 'required',
            'twitter'   => 'required',
            'instagram'   => 'required',
            'youtube'   => 'required',
            'whatsapp'   => 'required',
            'tiktok'   => 'required',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $model = Setting::find($request->id);
                $model->facebook = $request->facebook;
                $model->twitter = $request->twitter;
                $model->youtube = $request->youtube;
                $model->youtube = $request->youtube;
                $model->whatsapp = $request->whatsapp;
                $model->tiktok = $request->tiktok;
                $model->instagram = $request->instagram;
                $model->save();
            });

            return Inertia::location(route('setting.create'));
            return redirect()->back()->with('message', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
