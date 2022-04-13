<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Seeder;

class EventCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        EventCategory::create([
            'name' => 'bälle'
        ]);

        EventCategory::create([
            'name' => 'sport'
        ]);

        EventCategory::create([
            'name' => 'sonstige'
        ]);
    }
}
