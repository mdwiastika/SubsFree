<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'category_room_id' => 1,
                'user_id' => 3,
                'name_room' => 'Kamar yang Mantap',
                'slug_room' => 'kamar-yang-mantap',
                'location_room' => 'Jl. Kedondong, Surabaya, Jawa Timur',
                'photo_room' => null,
                'description_room' => 'Sipppp Lah',
                'level_room' => 'Class 1',
            ],
            [
                'category_room_id' => 2,
                'user_id' => 3,
                'name_room' => 'Apart nya deket pantai',
                'slug_room' => 'apart-nya-deket-pantai',
                'location_room' => 'Jalan Gunungsari, Bali, Indonesia',
                'photo_room' => null,
                'description_room' => 'Sipppp Lah',
                'level_room' => 'Class 2',
            ],
        ];
        Room::insert($rooms);
    }
}
