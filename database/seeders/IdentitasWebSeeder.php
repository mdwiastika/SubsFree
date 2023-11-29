<?php

namespace Database\Seeders;

use App\Models\IdentitasWeb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentitasWebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $identitas_web = [
            'name_company' => 'Sazam',
            'logo_company' => null,
            'banner_company' => null,
            'video_company' => null,
            'about_company' => 'Ini Adalah contoh about nya',
            'pembayaran_level_1' => 20000,
            'pembayaran_level_2' => 40000,
            'pembayaran_level_3' => 50000,
        ];
        IdentitasWeb::create($identitas_web);
    }
}
