<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnalyticFactory extends Factory
{
    public function definition()
    {
        return [
            'hash' => hash('md5', date('Y/m/d/H:i:s')),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-4 months', $endDate = 'now'),
            'browser_info' => 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0'
        ];
    }
}