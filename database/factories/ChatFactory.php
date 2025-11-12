<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    protected $model = Chat::class;

    public function definition()
    {
        return [
            'sender_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'receiver_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'message' => $this->faker->sentence(),
            'attachment' => null,
        ];
    }
}
