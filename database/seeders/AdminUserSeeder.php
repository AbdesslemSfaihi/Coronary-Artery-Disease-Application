<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'abdesslemsfaihi@gmail.com'], // Change this to your real admin email
            [
                'name' => 'Administrator',
                'password' => Hash::make('slouma55'), // Change to a strong password
                'role' => 'admin',
            ]
        );
    }
}
