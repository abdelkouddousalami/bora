<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => User::ROLE_USER,
        ]);

        // Create some test users with reservations
        User::factory(5)
            ->hasReservations(3)
            ->create(['role' => User::ROLE_USER]);
    }
}
