<?php

use App\EventCategory;
use Illuminate\Database\Seeder;

class EventCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
