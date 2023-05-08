<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Sell;
use App\Models\Voucher;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try{
            $request->validate([
                'user_id'   => 'required',
                'server_id'   => 'required',
                'voucher_id'   => 'required',
                'payment_method'   => 'required',
                'phone'   => 'required',
            ]);

            $getVoucher = Voucher::findOrFail($request->voucher_id);
                
            if(Sell::count()==0){
                $code = '00001';
            }
            else{
                $maxCode = Sell::max('code');
                $code = (int) $maxCode + 1;
                $code = sprintf("%05s", $code);
            }
            
            $sell = new Sell;
            $sell->code = $code;
            $sell->phone = $request->phone;
            $sell->username_game = $request->user_id;
            $sell->server_id = $request->server_id;
            $sell->voucher_id = $request->voucher_id;
            $sell->amount = $getVoucher->amount;
            $sell->margin = $getVoucher->margin;
            $sell->payment_method = strtolower($request->payment_method);
            $sell->url = md5($code);
            $sell->save();
            
            return redirect('order-success/'.$sell->url);
        }
        catch(\Exception $e){
            return redirect()->back()->with('message','Terjadi kesalahan. : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->with('message','Terjadi kesalahan pada database : '. $e->getMessage());
        }    
    }

    public function orderSuccess($url)
    {
        $sell = Sell::with('voucher.product')->where('url',$url)->firstOrFail();

        return Inertia::render('Frontend/Order/Order-success', [
            'title' => 'Order Sukses',
            'sell' => $sell,
        ]);
    }

    public function proofOfPayment(Request $request)
    {
        try{

            $request->validate([
                'id'   => 'required',
                'image'   => 'required|mimes:jpeg,png,jpg',
            ]);

            $sell = Sell::findOrFail($request->id);
            $imageName = $sell->code.".".$request->file('image')->extension();
            $image_path = $request->file('image')->storeAs('public/proof-of-payment', $imageName);
            $sell->proof_of_payment = $imageName;
            $sell->save();

            return redirect('upload-success/'.$sell->url);
        }
        catch(\Exception $e){
            return redirect()->back()->with('message','Terjadi kesalahan. : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->with('message','Terjadi kesalahan pada database : '. $e->getMessage());
        }          
    }
}
