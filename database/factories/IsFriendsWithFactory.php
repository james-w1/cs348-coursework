<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IsFriendsWith>
 */
class IsFriendsWithFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $idOne = User::inRandomOrder()->first()->id;
        $idTwo = User::inRandomOrder()->where('id', '!=', $idOne)->first()->id;

        return [
            'user_id' => $idOne,
            'friend_id' => $idTwo,
        ];
    }
}
