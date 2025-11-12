<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'type',
        'duration',
        'negative_marking',
        'available_from',
        'available_to',
        'created_by'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }
}


//use tinkering here

// use App\Models\Test;

// for ($i = 1; $i <= 20; $i++) {
//     Test::create([
//         'title' => 'Test '.$i,
//         'description' => 'Description for Test '.$i,
//         'category' => ['Maths','GK','English','Science'][array_rand(['Maths','GK','English','Science'])],
//         'type' => rand(0,1) ? 'Mock' : 'Grand',
//         'duration' => rand(30,120),
//         'negative_marking' => rand(0,1),
//         'available_from' => now(),
//         'available_to' => now()->addDays(7),
//         'created_by' => rand(1,20)
//     ]);
// }

