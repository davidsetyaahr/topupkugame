<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@mail.com';
        $user->password = Hash::make('password');
        $user->save();
        Schema::enableForeignKeyConstraints();
    }
}
