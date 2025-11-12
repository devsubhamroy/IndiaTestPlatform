<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'attempt_id',
        'total_marks',
        'correct_count',
        'wrong_count',
        'rank'
    ];

    public function attempt()
    {
        return $this->belongsTo(Attempt::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'attempt_id', 'id');
    }
}


// use App\Models\Result;

// for ($i = 1; $i <= 20; $i++) {
//     Result::create([
//         'attempt_id' => $i,
//         'total_marks' => rand(40, 100),
//         'correct_count' => rand(10, 25),
//         'wrong_count' => rand(0, 10),
//         'rank' => $i
//     ]);
// }
