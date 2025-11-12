<?php
use App\Models\Result;
use App\Models\Attempt;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResultFactory extends Factory
{
    protected $model = Result::class;

    public function definition()
    {
        return [
            'attempt_id' => Attempt::inRandomOrder()->first()->id ?? Attempt::factory(),
            'total_marks' => $this->faker->randomFloat(2, 0, 100),
            'correct_count' => $this->faker->numberBetween(0, 20),
            'wrong_count' => $this->faker->numberBetween(0, 10),
            'rank' => $this->faker->numberBetween(1, 100),
        ];
    }
}
