<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;

class PersonTableSeeder extends Seeder
{
    public function run()
    {
        Person::factory()->count(50)->create();
    }
}
