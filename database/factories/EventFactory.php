<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    $cont = $faker->randomElement([
        ['name' => 'Maturaball', 'location' => 'im Bg/Brg Weiz', 'category' => 1],
        ['name' => 'Tanzkränzchen', 'location' => 'im Garten der Generationen', 'category' => 1],
        ['name' => 'Leichtathletik', 'location' => 'am Sportplatz', 'category' => 2],
        ['name' => 'Gesundes Frühstück', 'location' => 'beim Bleykolm Weiz', 'category' => 3],
    ]);
    $sentence = $faker->sentences($nb = 3, $asText = true);

    return [
        'name' => $cont['name'],
        'event_category_id' => $cont['category'],
        'markup' => $sentence,
        'html' => $sentence,
        'date' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = '+3 years', $timezone = date_default_timezone_get()),
        'location' => $cont['location']
    ];
});
