<?php

use App\SiteCategory;
use Illuminate\Database\Seeder;

class SiteCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteCategory::create([
            'name' => 'bälle'
        ]);

        SiteCategory::create([
            'name' => 'sport'
        ]);

        SiteCategory::create([
            'name' => 'sonstige'
        ]);
    }
}
