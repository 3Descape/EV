<?php

use Illuminate\Database\Seeder;
use App\PeopleCategory;

class PeopleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PeopleCategory::create([
            'name' => 'sga',
            'has_image' => true
        ]);

        PeopleCategory::create([
            'name' => 'ev',
            'has_image' => false
        ]);

        PeopleCategory::create([
            'name' => 'vorstand',
            'has_image' => true
        ]);
    }
}
