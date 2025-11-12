<?php
use App\Models\Question;
use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        $options = [$this->faker->word(), $this->faker->word(), $this->faker->word(), $this->faker->word()];
        $correct = [$this->faker->numberBetween(0,3)];
        return [
            'test_id' => Test::inRandomOrder()->first()->id ?? Test::factory(),
            'title' => $this->faker->sentence(),
            'options' => $options,
            'correct_answer' => $correct,
            'marks' => 2,
            'negative' => 0.5,
            'difficulty' => $this->faker->randomElement(['easy','medium','hard']),
            'category' => $this->faker->randomElement(['Maths','GK','English']),
        ];
    }
}
