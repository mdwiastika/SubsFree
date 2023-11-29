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
                'no_wa' => '0891728192',
                'level_user' => 'Super Admin',
                'level_subscription' => 'Class 1',
                'proof_authenticity' => null,
                'status_user' => 'Active',
                'password' => Hash::make('superadmin'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'no_wa' => '0891728192',
                'level_user' => 'Admin',
                'level_subscription' => 'Class 1',
                'proof_authenticity' => null,
                'status_user' => 'Active',
                'password' => Hash::make('admin'),
            ],
            [
                'name' => 'Partner',
                'email' => 'partner@gmail.com',
                'no_wa' => '0891728192',
                'level_user' => 'Partner',
                'level_subscription' => 'Class 1',
                'proof_authenticity' => null,
                'status_user' => 'Active',
                'password' => Hash::make('partner'),
            ],
            [
                'name' => 'Regular',
                'email' => 'regular@gmail.com',
                'no_wa' => '0891728192',
                'level_user' => 'Regular',
                'level_subscription' => 'Class 1',
                'proof_authenticity' => null,
                'status_user' => 'Active',
                'password' => Hash::make('regular'),
            ],
        ];
        User::insert($users);
    }
}
