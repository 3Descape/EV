<?php

use Faker\Generator as Faker;

$factory->define(App\Analythic::class, function (Faker $faker) {
    return [
        'hash' => hash('md5', date('Y/m/d/H:i:s')),
        'created_at' => $faker->dateTimeBetween($startDate = '-4 months', $endDate = 'now'),
        'browser_info' => 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0'
    ];
});
