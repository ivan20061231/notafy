<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::create([
        'name' => 'Admin',
        'email' => 'admin@notafy.com',
        'password' => bcrypt('password'),
        'role' => 'admin'
        ]);
        User::create([
        'name' => 'Estudiante',
        'email' => 'estudiante@notafy.com',
        'password' => bcrypt('password'),
        'role' => 'estudiante'
        ]);
        User::create([
        'name' => 'Profesor',
        'email' => 'profesor@notafy.com',
        'password' => bcrypt('password'),
        'role' => 'profesor'
        ]);


    }
}
