<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT AKUN ADMIN OTOMATIS
        User::create([
            'name' => 'Administrator Kripkongs',
            'email' => 'admin@kripkongs.com',
            'password' => Hash::make('passwordadmin'), // Password login admin
            'role' => 'admin',
        ]);

        // 2. JALANKAN SEEDER PRODUK YANG SUDAH KAMU BUAT
        $this->call([
            ProductSeeder::class,
        ]);
    }
}