<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'superadmin@warung-soto.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'phone' => '081234567890',
                'role' => 'superadmin'
            ]
        );

        Admin::updateOrCreate(
            ['email' => 'admin@warung-soto.com'],
            [
                'name' => 'Admin Warung',
                'password' => Hash::make('password123'),
                'phone' => '081234567891',
                'role' => 'admin'
            ]
        );
    }
}
