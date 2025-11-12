<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class, 'created_by');
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class, 'student_id');
    }

    public function sentChats()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function receivedChats()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }
   
}


//use tinker
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;

// for ($i = 1; $i <= 20; $i++) {
//     User::create([
//         'name' => 'User'.$i,
//         'email' => 'user'.$i.'@mail.com',
//         'password' => Hash::make('password'),
//         'role_id' => rand(1, 3),
//     ]);
// }
