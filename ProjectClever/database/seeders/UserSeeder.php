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
            'name' => 'Admin User',
            'email' => 'admin@clever.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create sample freelancer
        User::create([
            'name' => 'Sample Freelancer',
            'email' => 'freelancer@clever.com',
            'password' => Hash::make('password'),
            'role' => 'freelancer',
            'is_active' => true,
        ]);

        // Create sample client
        User::create([
            'name' => 'Sample Client',
            'email' => 'client@clever.com',
            'password' => Hash::make('password'),
            'role' => 'client',
            'is_active' => true,
        ]);
    }
}
