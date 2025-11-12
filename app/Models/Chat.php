<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id', 'receiver_id', 'message', 'attachment'
    ];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}

// use App\Models\Chat;

// for ($i = 1; $i <= 20; $i++) {
//     Chat::create([
//         'sender_id' => rand(1, 20),
//         'receiver_id' => rand(1, 20),
//         'message' => 'Random message '.$i,
//         'attachment' => null
//     ]);
// }
