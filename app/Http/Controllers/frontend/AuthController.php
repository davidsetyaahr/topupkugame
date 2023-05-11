<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login()
    {
        $data = array(
            'page'  => 'create',
            'email'  => '',
            'password'  => '',
        );
        return Inertia::render('Frontend/Auth/Login', [
            'data' => $data,
        ]);
    }

    public function register()
    {
        $data = array(
            'page'  => 'create',
            'id'    => '',
            'name'  => '',
            'phone'  => '',
            'email'  => '',
            'password'  => '',
        );
        return Inertia::render('Frontend/Auth/Register', [
            'data' => $data,
        ]);
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'email'   => 'required|unique:customers,email',
            'phone'   => 'required',
            'password'   => 'required',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $model = new Customer();
                $model->name = $request->name;
                $model->email = $request->email;
                $model->phone = $request->phone;
                $model->password = Hash::make($request->password);
                $model->save();
            });

            return redirect('auth-customer/login')->with('message', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('message', 'Terjadi kesalahan pada database : ' . $e);
        }
    }

    public function storeLogin(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'password'   => 'required',
        ]);
        try {
            $data = Customer::where('email', $request->email)->first();
            if ($data != null) {
                if (!Hash::check($request->password, $data->password)) {
                    return redirect('auth-customer/login')->with('message', 'Password salah.');
                } else {
                    Session::put('email', $data->email);
                    return redirect('/');
                }
            } else {
                return redirect('auth-customer/login')->with('message', 'Akun tidak ditemukan.');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
    }

    public function checkSession()
    {
        return Session::get('email');
    }

    public function logout()
    {
        Session::flush();
        return redirect('auth-customer/login')->with('message', 'Logout berhasil.');
    }
}
