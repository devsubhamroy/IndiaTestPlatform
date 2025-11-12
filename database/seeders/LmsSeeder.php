<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Role, User, Test, Question, Attempt, Result, Chat
};

class LmsSeeder extends Seeder
{
    public function run(): void
    {
        Role::factory(3)->create(); // Admin, Instructor, Student
        User::factory(20)->create();
        Test::factory(20)->create();
        Question::factory(20)->create();
        Attempt::factory(20)->create();
        Result::factory(20)->create();
        Chat::factory(20)->create();
    }
}

