<?php

namespace Database\Seeders;

use App\Models\Analytic;
use Illuminate\Database\Seeder;

class AnalyticsTableSeeder extends Seeder
{
    public function run()
    {
        Analytic::factory()->count(200)->create();
    }
}
