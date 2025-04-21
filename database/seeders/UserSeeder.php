<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@tanzaniasafari.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        // Add more users if needed for testing
        if (app()->environment('local', 'development', 'testing')) {
            User::create([
                'name' => 'Test User',
                'email' => 'test@tanzaniasafari.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'user',
            ]);
        }
    }
}
