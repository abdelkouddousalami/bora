<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Grilled Fish Platter',
                'description' => 'Fresh catch of the day grilled to perfection, served with seasonal vegetables and lemon butter sauce.',
                'price' => 24.99,
                'is_active' => true,
            ],
            [
                'name' => 'Seafood Pasta',
                'description' => 'Homemade pasta with mixed seafood in a rich tomato sauce.',
                'price' => 19.99,
                'is_active' => true,
            ],
            [
                'name' => 'Fish and Chips',
                'description' => 'Classic beer-battered fish served with crispy fries and tartar sauce.',
                'price' => 16.99,
                'is_active' => true,
            ],
            [
                'name' => 'Seafood Paella',
                'description' => 'Traditional Spanish rice dish with various seafood and saffron.',
                'price' => 29.99,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
