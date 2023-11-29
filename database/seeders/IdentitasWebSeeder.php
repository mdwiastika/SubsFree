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
            'no_wa_company' => '07812812812',
            'address_company' => 'Surabaya, Jawa Timur, Indonesia',
            'email_company' => 'sazam@gmail.com',
            'twitter_company' => 'sazam',
            'facebook_company' => 'sazam',
            'instagram_company' => 'sazam',
            'logo_company' => null,
            'banner_company' => null,
            'title_banner_company' => 'Langganan Bersama Kami Pasti Murah',
            'video_company' => null,
            'payment_class_1' => 20000,
            'payment_class_2' => 40000,
            'payment_class_3' => 50000,
        ];
        IdentitasWeb::create($identitas_web);
    }
}
