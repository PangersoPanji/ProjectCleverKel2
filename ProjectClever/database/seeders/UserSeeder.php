<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin Clever',
            'email' => 'admin@clever.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create freelancer
        User::create([
            'name' => 'Freelancer',
            'email' => 'freelancer@clever.com',
            'password' => Hash::make('password'),
            'role' => 'freelancer',
            'is_active' => true,
        ]);

        // Create client
        User::create([
            'name' => 'Client',
            'email' => 'client@clever.com',
            'password' => Hash::make('password'),
            'role' => 'client',
            'is_active' => true,
        ]);
    }
}
