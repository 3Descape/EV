<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->name,
            'email' => $this->unique()->safeEmail,
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
        ];
    }
}