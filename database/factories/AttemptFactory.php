<?php

use App\Models\Attempt;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttemptFactory extends Factory
{
    protected $model = Attempt::class;

    public function definition()
    {
        return [
            'test_id' => Test::inRandomOrder()->first()->id ?? Test::factory(),
            'student_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'start_time' => now(),
            'end_time' => now()->addMinutes(90),
            'score' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement(['in_progress', 'submitted']),
        ];
    }
}
