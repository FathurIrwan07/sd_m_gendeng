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
            ['email' => 'admin1@gmail.com'], // Cek jika user sudah ada
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'), // Ganti password sesuai keinginan
                'role' => 'admin',
            ]
        );
    }
}
