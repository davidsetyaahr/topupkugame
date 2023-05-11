<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Sell;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Backend/Sell/Index', [
            'title' => 'Pemesanan',
            'sell' => Sell::with('customer')->with('voucher.product')->where('status', '0')->orderBy('id', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function rekap(Request $request)
    {
        $margin = 0;
        $total = 0;
        $filter = [
            'dari' => $request->dari ? $request->dari : '',
            'sampai' => $request->sampai ? $request->sampai : '',
        ];
        $data = Sell::with('customer')->with('voucher.product')->where('status', '1');
        if ($filter['dari'] != '' && $filter['sampai'] != '') {
            $data = $data->whereBetween('created_at', [$filter['dari'] . " 00:00:00", $filter['sampai'] . " 23:59:59"]);
        }
        $data = $data->get();
        foreach ($data as $key => $value) {
            $margin += $value->margin;
            $total += $value->amount;
        }
        return Inertia::render('Backend/Sell/Rekap', [
            'title' => 'Rekap',
            'data' => $data,
            'filter' => $filter,
            'margin' => $margin,
            'total' => $total,
        ]);
    }

    public function acc($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $model = Sell::find($id);
                $model->status = '1';
                $model->save();
            });

            return redirect()->route('pemesanan.index')->with('message', 'Data berhasil diterima.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e);
        }
    }

    public function reject($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $model = Sell::find($id);
                $model->status = '2';
                $model->proof_of_payment = null;
                $model->save();
            });

            return redirect()->route('pemesanan.index')->with('message', 'Data berhasil diterima.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e);
        }
    }
}
