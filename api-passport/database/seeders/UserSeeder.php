<?php

namespace Database\Seeders;

use Hash;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' =>  User::ROLE_ADMIN,
            'avatar' => 'images/games/narutostorm4.jpg'
        ]);

        User::create([
            'name' => 'lucasdev',
            'email' => 'lucas@test.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_USER,
            'avatar' => 'images/avatars/momo.jpg'

        ]);
    }
}
