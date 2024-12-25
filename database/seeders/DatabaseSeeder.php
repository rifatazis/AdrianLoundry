<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Pengguna::create([
            'username' => 'admin2',
            'password' => Hash::make('password123'),
            'role' => "administrator" 
        ]);
    }
}
