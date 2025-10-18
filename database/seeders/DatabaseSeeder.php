<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === SUPERADMIN ===
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'cabang' => null,
        ]);

        // === ADMIN BANJARBARU ===
        User::create([
            'name' => 'Admin Banjarbaru',
            'email' => 'banjarbaru@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin_cabang',
            'cabang' => 'banjarbaru',
        ]);

        // === ADMIN MARTAPURA ===
        User::create([
            'name' => 'Admin Martapura',
            'email' => 'martapura@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin_cabang',
            'cabang' => 'martapura',
        ]);

        // === ADMIN LIANG ANGGANG ===
        User::create([
            'name' => 'Admin Liang Anggang',
            'email' => 'liang@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin_cabang',
            'cabang' => 'lianganggang',
        ]);
    }
}
