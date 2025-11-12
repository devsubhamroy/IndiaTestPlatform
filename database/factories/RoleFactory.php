<?php

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        $roles = ['Admin', 'Instructor', 'Student'];
        return ['name' => $this->faker->unique()->randomElement($roles)];
    }
}
