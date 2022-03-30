<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition()
    {
        $cont = $this->faker->randomElement([
            ['name' => 'Maturaball', 'location' => 'im Bg/Brg Weiz', 'category' => 1],
            ['name' => 'Tanzkränzchen', 'location' => 'im Garten der Generationen', 'category' => 1],
            ['name' => 'Leichtathletik', 'location' => 'am Sportplatz', 'category' => 2],
            ['name' => 'Gesundes Frühstück', 'location' => 'beim Bleykolm Weiz', 'category' => 3],
        ]);

        $sentence = $this->faker->sentences($nb = 3, $asText = true);

        return [
            'name' => $cont['name'],
            'event_category_id' => $cont['category'],
            'markup' => $sentence,
            'html' => $sentence,
            'date' => $this->faker->dateTimeBetween($startDate = '-5 years', $endDate = '+3 years', $timezone = date_default_timezone_get()),
            'location' => $cont['location']
        ];
    }
}