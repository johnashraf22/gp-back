<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'seller',
            'email' => 'seller@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'seller',
        ]);

        Category::create([
            'name' => 'Books',
            'is_main' => true,
        ]);
        Category::create([
            'name' => 'Clothes',
            'is_main' => true,
        ]);
    }
}
