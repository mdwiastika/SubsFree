<?php

namespace Database\Seeders;

use App\Models\CategoryRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category_rooms = [
            [
                'name_category_room' => 'Villa',
                'icon_category_room' => 'image-upload\category-room\0YV20b72bd9eed1243ac508ba63b7c79daea4013ad920f88d2c0442194fbb9f3d739.png',
                'slug_category_room' => 'villa',
            ],
            [
                'name_category_room' => 'Apartment Room',
                'icon_category_room' => 'image-upload\category-room\5zx9cd2fad2179a23a2e31f5c8ec284b9aa0672f4616f16e3e21e3ee967784487d5d.png',
                'slug_category_room' => 'apartment-room',
            ],
        ];
        CategoryRoom::insert($category_rooms);
    }
}
