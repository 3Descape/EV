<?php

use Faker\Generator as Faker;

$factory->define(App\Person::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'markup' => $faker->sentences($nb = 1, $asText = true),
        'html' => $faker->sentences($nb = 1, $asText = true),
        'person_category_id' => $faker->numberBetween($min = 1, $max = 3),
    ];
});
