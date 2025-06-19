<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        $statuses = ['pending', 'confirmed', 'cancelled'];
        
        return [
            'user_id' => User::factory(),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'tour_type' => fake()->randomElement(['City Tour', 'Beach Tour', 'Mountain Tour', 'Cultural Tour']),
            'date' => fake()->dateTimeBetween('now', '+3 months'),
            'guests' => fake()->numberBetween(1, 5),
            'message' => fake()->optional()->sentence(),
            'status' => fake()->randomElement($statuses),
        ];
    }

    public function pending()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    public function confirmed()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'confirmed',
        ]);
    }

    public function cancelled()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
        ]);
    }
}
