<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Normal Customer',
            'email' => 'normal@example.com',
            'password' => Hash::make('password'),
            'is_vip' => false,
        ]);

        User::create([
            'name' => 'VIP Customer',
            'email' => 'vip@example.com',
            'password' => Hash::make('password'),
            'is_vip' => true,
        ]);
    }
}
