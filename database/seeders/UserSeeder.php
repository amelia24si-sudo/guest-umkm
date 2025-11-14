<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@umkmdesa.id',
            'password' => Hash::make('password123'),
        ]);

        // User::create([
        //     'name' => 'User Biasa',
        //     'email' => 'user@umkmdesa.id',
        //     'password' => Hash::make('password123'),
        // ]);
    }
}
