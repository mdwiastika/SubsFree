<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'no_telp' => '0891728192',
                'level_user' => 'Super Admin',
                'level_subscription' => 'Level 1',
                'bukti_keaslian' => null,
                'status_user' => 'Aktif',
                'password' => Hash::make('superadmin'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'no_telp' => '0891728192',
                'level_user' => 'Admin',
                'level_subscription' => 'Level 1',
                'bukti_keaslian' => null,
                'status_user' => 'Aktif',
                'password' => Hash::make('admin'),
            ],
            [
                'name' => 'Mitra',
                'email' => 'mitra@gmail.com',
                'no_telp' => '0891728192',
                'level_user' => 'Mitra',
                'level_subscription' => 'Level 1',
                'bukti_keaslian' => null,
                'status_user' => 'Aktif',
                'password' => Hash::make('mitra'),
            ],
            [
                'name' => 'Pengguna',
                'email' => 'pengguna@gmail.com',
                'no_telp' => '0891728192',
                'level_user' => 'Pengguna',
                'level_subscription' => 'Level 1',
                'bukti_keaslian' => null,
                'status_user' => 'Aktif',
                'password' => Hash::make('pengguna'),
            ],
        ];
        User::insert($users);
    }
}
