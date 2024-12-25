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
            'username' => 'admin123',
            'password' => Hash::make('admin123'),
            'role' => "administrator" 
        ]);
    }
}
