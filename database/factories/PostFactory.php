<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => Fake()->word(),
            'body' => Fake()->sentence(30),
            'user_id' => User::inRandomOrder()->first()->id,
            'image_path' => Fake()->image('storage/app/public/images'),
            'image_name' => Fake()->word() . '.png',
        ];
    }
}
