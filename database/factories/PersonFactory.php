<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'markup' => $this->faker->sentences($nb = 1, $asText = true),
            'person_category_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'email' => $this->faker->email(),
        ];
    }
}