<?php

namespace Database\Factories;

use App\Models\FriendRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class FriendRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => User::factory(), // creates a user if not provided
            'reciever_id' => $this->faker->paragraph(),
            'status' => rand('pending','accepted'), // or fake image if you want
        ];
    }
}
