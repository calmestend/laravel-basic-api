<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'password' => bcrypt('password'),
            'role' => 2
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 1
        ]);

        Category::factory()->create([
            'name' => 'category 1'
        ]);

        Category::factory()->create([
            'name' => 'category 2'
        ]);

        Category::factory()->create([
            'name' => 'category 3'
        ]);
    }
}
