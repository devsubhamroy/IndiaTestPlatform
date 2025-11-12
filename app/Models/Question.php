<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'qns',
        'marks',
        'negative',
        'created_by',
        'duration',
        'difficulty',
        'category',
    ];


    protected $casts = [
        'options' => 'array',
        'correct_answer' => 'array'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}

//use tinker here
// use App\Models\Question;

// for ($i = 1; $i <= 20; $i++) {
//     $options = ['A'.$i, 'B'.$i, 'C'.$i, 'D'.$i];
//     $correct = [array_rand($options)];

//     Question::create([
//         'test_id' => rand(1, 20),
//         'title' => 'Question '.$i.' ?',
//         'options' => json_encode($options),
//         'correct_answer' => json_encode($correct),
//         'marks' => 2,
//         'negative' => 0.5,
//         'difficulty' => ['easy','medium','hard'][array_rand(['easy','medium','hard'])],
//         'category' => ['Maths','GK','English','Science'][array_rand(['Maths','GK','English','Science'])]
//     ]);
// }
