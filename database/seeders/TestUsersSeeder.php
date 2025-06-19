<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Create some test users
        $users = [
            [
                'name' => 'Test User 1',
                'email' => 'test1@example.com',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_USER,
            ],
            [
                'name' => 'Test User 2',
                'email' => 'test2@example.com',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_USER,
            ],
            [
                'name' => 'Test User 3',
                'email' => 'test3@example.com',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_USER,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
