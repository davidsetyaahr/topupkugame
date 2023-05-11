<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::truncate();

        $new = new Setting;
        $new->facebook = 'Test facebook';
        $new->instagram = 'Test instagram';
        $new->twitter = 'Test twitter';
        $new->youtube = 'Test youtube';
        $new->whatsapp = '082';
        $new->tiktok = 'Test tiktok';
        $new->save();
    }
}
