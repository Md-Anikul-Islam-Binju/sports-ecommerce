<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'sports@admin.com',
            'phone' => '01905256528',
            'address' => 'Online Shop',
            'role' => 'admin',
            'gender' => 'male',
            'profile' => '',
            'password' => bcrypt('wingssports@2025')
        ]);

    }
}
