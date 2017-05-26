<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    public function run()
    {
      $events = factory(App\Event::class, 50)->create();
    }
}
