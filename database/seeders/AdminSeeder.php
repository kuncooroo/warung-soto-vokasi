<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@warung-soto.com',
            'password' => Hash::make('password123'), 
            'phone' => '081234567890',
            'role' => 'superadmin'
        ]);

        Admin::create([
            'name' => 'Admin Warung',
            'email' => 'admin@warung-soto.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567891',
            'role' => 'admin'
        ]);
    }
}