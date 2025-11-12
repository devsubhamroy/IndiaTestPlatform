<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'student_id',
        'start_time',
        'end_time',
        'score',
        'status'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }
}

// use App\Models\Attempt;

// for ($i = 1; $i <= 20; $i++) {
//     Attempt::create([
//         'test_id' => rand(1, 20),
//         'student_id' => rand(1, 20),
//         'start_time' => now(),
//         'end_time' => now()->addMinutes(rand(30,120)),
//         'score' => rand(0, 100),
//         'status' => rand(0,1) ? 'submitted' : 'in_progress'
//     ]);
// }
