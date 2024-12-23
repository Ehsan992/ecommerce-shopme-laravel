<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate(); // Remove all existing records before seeding

        // Seed new data
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            // Add other column values as needed
            'password' => bcrypt('password'),
        ]);
    }
}
