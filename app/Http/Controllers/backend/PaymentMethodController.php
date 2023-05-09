<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Backend/PaymentMethod/Index', [
            'title' => 'Banner',
            'data' => PaymentMethod::where('bank', 'like', "%" . $request->key . "%")->get(),
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
        $paymentMethod = PaymentMethod::find($id);
        $data = array(
            'page'  => 'edit',
            'id'    => $id,
            'bank'  => $paymentMethod->bank,
            'name'  => $paymentMethod->name,
            'account_no'  => $paymentMethod->number,
        );
        return Inertia::render('Backend/PaymentMethod/Form', [
            'title' => 'Edit Payment Method',
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
            'bank'   => 'required',
            'account_no'   => 'required',
        ]);
        try {
            DB::transaction(function () use ($request, $id) {
                $model = PaymentMethod::find($id);
                $model->name = $request->name;
                $model->bank = $request->bank;
                $model->number = $request->account_no;
                $model->save();
            });

            return redirect()->route('payment-method.index')->with('message', 'Data berhasil ditambahkan.');
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
        //
    }
}
