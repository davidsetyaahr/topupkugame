<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Schema::disableForeignKeyConstraints();
        PaymentMethod::truncate();

        $new = new PaymentMethod;
        $new->bank = 'BCA';
        $new->name = 'Akun BCA';
        $new->number = '1200';
        $new->save();

        $new = new PaymentMethod;
        $new->bank = 'Dana';
        $new->name = 'Akun Dana';
        $new->number = '082';
        $new->save();
        \Schema::enableForeignKeyConstraints();
    }
}
