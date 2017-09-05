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
        ['name' => 'Maturaball', 'location' => 'im Bg/Brg Weiz', 'category' => 1],
        ['name' => 'Tanzkränzchen', 'location' => 'im Garten der Generationen', 'category' => 1],
        ['name' => 'Leichtathletik', 'location' => 'am Sportplatz', 'category' => 2],
        ['name' => 'Gesundes Frühstück', 'location' => 'beim Bleykolm Weiz', 'category' => 3],
    ]);
    return [
        'name' => $cont['name'],
        'category_id' => $cont['category'],
        'description' => $faker->sentences($nb = 3,$asText = true),
        'date' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = '+3 years', $timezone = date_default_timezone_get()),
        'location' => $cont['location'],
    ];
});

$factory->define(App\Person::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentences($nb = 1,$asText = true),
        'category' => $faker->numberBetween($min = 0, $max = 3),
    ];
});

$factory->define(App\Analythic::class, function (Faker\Generator $faker) {
    return [
        'hash' => hash('md5', date('Y/m/d/H:i:s')),
        'created_at' => $faker->dateTimeBetween($startDate = '-4 months', $endDate = 'now'),
        'browser_info' => "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0"
    ];
});
