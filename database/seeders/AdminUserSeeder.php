<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'user1@gmail.com'],
            [
                'username' => 'user1',
                'nama_lengkap' => 'Pengguna Biasa',
                'password' => Hash::make('userpassword'),
                'role_id' => 2,
            ]
        );
    }
}
