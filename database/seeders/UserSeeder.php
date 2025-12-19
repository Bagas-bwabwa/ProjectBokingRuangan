<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@booking.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Staff
        User::create([
            'name' => 'Staff 1',
            'email' => 'staff1@booking.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        User::create([
            'name' => 'Staff 2',
            'email' => 'staff2@booking.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        // Create Guest User
        User::create([
            'name' => 'Guest User',
            'email' => 'guest@booking.com',
            'password' => Hash::make('password'),
            'role' => 'guest',
        ]);
    }
}
