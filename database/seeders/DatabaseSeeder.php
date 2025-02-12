<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Location::create([
            'city' => 'Kurram Agency',
            'district' => 'Kurram Agency',
        ]);

        User::factory()->create([
            'name' => 'Super Admin',
            'location_id' => 1,
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'Admin',
        ]);

        User::factory()->create([
            'name' => 'Guard',
            'location_id' => 1,
            'email' => 'guard1@example.com',
            'password' => Hash::make('password'),
            'role' => 'guard',
        ]);
    }
}
