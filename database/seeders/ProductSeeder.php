<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Schema::disableForeignKeyConstraints();
        Product::truncate();
        $product = new Product();
        $product->company_id = 1;
        $product->name = 'Mobile Legend';
        $product->banner = 'null';
        $product->top_banner = 'null';
        $product->description = 'Mobile Legend';
        $product->url = 'mobile-legend';
        $product->save();

        $product = new Product();
        $product->company_id = 1;
        $product->name = 'Free Fire';
        $product->banner = 'null';
        $product->top_banner = 'null';
        $product->description = 'Free Fire';
        $product->url = 'free-fire';
        $product->save();

        $product = new Product();
        $product->company_id = 1;
        $product->name = 'PUBG';
        $product->banner = 'null';
        $product->top_banner = 'null';
        $product->description = 'PUBG';
        $product->url = 'pubg';
        $product->save();
        \Schema::enableForeignKeyConstraints();
    }
}
