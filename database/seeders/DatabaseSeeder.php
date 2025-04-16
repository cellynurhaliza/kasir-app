<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin test',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('123'),
        ]);

        User::factory()->create([
            'name' => 'Employee Test',
            'email' => 'employee@example.com',
            'role' => 'employee',
            'password' => bcrypt('123'),
        ]);
    }
}
