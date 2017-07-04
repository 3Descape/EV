<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Event::class, function (Faker\Generator $faker) {
    $cont = $faker->randomElement([
        ['name' => 'Maturaball', 'location' => 'im Bg/Brg Weiz', 'category' => 'bälle'],
        ['name' => 'Tanzkränzchen', 'location' => 'im Garten der Generationen', 'category' => 'bälle'],
        ['name' => 'Leichtathletik', 'location' => 'am Sportplatz', 'category' => 'sport'],
        ['name' => 'Gesundes Frühstück', 'location' => 'beim Bleykolm Weiz', 'category' => 'sonstige'],
    ]);
    return [
        'name' => $cont['name'],
        'description' => $faker->sentences($nb = 3,$asText = true),
        'date' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = '+3 years', $timezone = date_default_timezone_get()),
        'location' => $cont['location'],
        'category' => $cont['category'],
    ];
});

$factory->define(App\Person::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentences($nb = 1,$asText = true),
        'category' => $faker->numberBetween($min = 0, $max = 3),
    ];
});
