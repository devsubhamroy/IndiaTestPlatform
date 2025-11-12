<?php

use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    protected $model = Test::class;

    public function definition()
    {
        $type = $this->faker->randomElement(['Mock', 'Grand']);
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'category' => $this->faker->randomElement(['Maths','GK','English','Science']),
            'type' => $type,
            'duration' => $this->faker->numberBetween(30,120),
            'negative_marking' => $this->faker->boolean(),
            'available_from' => now(),
            'available_to' => now()->addDays(7),
            'created_by' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }
}

