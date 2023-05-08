<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Voucher;
use App\Models\Product;

class VouchersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Schema::disableForeignKeyConstraints();        
        Voucher::truncate();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '5 DIAMOND';
        $new->amount = 1990;
        $new->margin = 500;
        $new->save();

        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '14 DIAMOND';
        $new->amount = 3750;
        $new->margin = 250;
        $new->save();

        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '28 DIAMOND';
        $new->amount = 7500;
        $new->margin = 685;
        $new->save();

        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '42 DIAMOND';
        $new->amount = 11300;
        $new->margin = 1047;
        $new->save();

        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '56 DIAMOND';
        $new->amount = 14800;
        $new->margin = 1418;
        $new->save();

        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '114 DIAMOND';
        $new->amount = 28500;
        $new->margin = 2446;
        $new->save();

        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '172 DIAMOND';
        $new->amount = 39900;
        $new->margin = 2260;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '257 DIAMOND';
        $new->amount = 59700;
        $new->margin = 3901;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '344 DIAMOND';
        $new->amount = 79000;
        $new->margin = 3719;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '429 DIAMOND';
        $new->amount = 98250;
        $new->margin = 4001;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '514 DIAMOND';
        $new->amount = 119220;
        $new->margin = 6003;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '600 DIAMOND';
        $new->amount = 139000;
        $new->margin = 6815;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '706 DIAMOND';
        $new->amount = 159250;
        $new->margin = 8096;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '792 DIAMOND';
        $new->amount = 179200;
        $new->margin = 9078;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '878 DIAMOND';
        $new->amount = 198500;
        $new->margin = 9706;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '962 DIAMOND';
        $new->amount = 218300;
        $new->margin = 10538;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '1050 DIAMOND';
        $new->amount = 238500;
        $new->margin = 12066;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '1220 DIAMOND';
        $new->amount = 277500;
        $new->margin = 13129;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '1412 DIAMOND';
        $new->amount = 317000;
        $new->margin = 14642;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '1669 DIAMOND';
        $new->amount = 378920;
        $new->margin = 20004;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '2194 DIAMOND';
        $new->amount = 478100;
        $new->margin = 24046;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '2900 DIAMOND';
        $new->amount = 637000;
        $new->margin = 31792;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '3688 DIAMOND';
        $new->amount = 796000;
        $new->margin = 38453;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '4390 DIAMOND';
        $new->amount = 948800;
        $new->margin = 40099;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '5532 DIAMOND';
        $new->amount = 1187000;
        $new->margin = 50086;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '6235 DIAMOND';
        $new->amount = 1345000;
        $new->margin = 56933;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '7726 DIAMOND';
        $new->amount = 1660000;
        $new->margin = 69032;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '9288 DIAMOND';
        $new->amount = 1970000;
        $new->margin = 79096;
        $new->save();
        
        $new = new Voucher;
        $new->product_id = 1;
        $new->title = '12.976 DIAMOND';
        $new->amount = 2690000;
        $new->margin = 41548;
        $new->save();
        \Schema::enableForeignKeyConstraints();        
    }
}
