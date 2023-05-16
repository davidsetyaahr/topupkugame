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
        $data = array(
            'page'  => 'create',
            'id'    => '',
            'bank'  => '',
            'name'  => '',
            'account_no'  => '',
        );
        return Inertia::render('Backend/PaymentMethod/Form', [
            'title' => 'Create Payment Method',
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'img'   => 'required|mimes:jpeg,png,jpg,webp',
            'name'   => 'required',
            'bank'   => 'required',
            'account_no'   => 'required',
        ], [
            'required' => ':attribute harus diisi.'
        ]);
        try {
            DB::transaction(function () use ($request) {
                $document = $request->img;
                $document->storeAs('public/payment-method', $document->hashName());
                $model = new PaymentMethod();
                $model->name = $request->name;
                $model->number = $request->account_no;
                $model->bank = $request->bank;
                $model->img = $document->hashName();
                $model->save();
            });

            return Inertia::location(route('payment-method.index'));
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
        $paymentMethod = PaymentMethod::find($id);
        $data = array(
            'page'  => 'edit',
            'id'    => $id,
            'name'  => $paymentMethod->name,
            'bank'  => $paymentMethod->bank,
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
            'account_no'   => 'required',
            'bank'   => 'required',
        ]);
        try {
            DB::transaction(function () use ($request, $id) {
                if ($request->img) {
                    $document = $request->img;
                    $document->storeAs('public/payment-method', $document->hashName());
                }
                $model = PaymentMethod::find($id);
                if ($request->img) {
                    $model->img = $document->hashName();
                }
                $model->bank = $request->bank;
                $model->name = $request->name;
                $model->number = $request->account_no;
                $model->save();
            });

            return Inertia::location(route('payment-method.index'));
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
            PaymentMethod::find($id)->delete();

            return Inertia::location(route('payment-method.index'));
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e);
        }
    }
}
