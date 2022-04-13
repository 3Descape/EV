<?php

namespace Database\Seeders;

use App\Models\SiteCategory;
use Illuminate\Database\Seeder;

class SiteCategoryTableSeeder extends Seeder
{
    public function run()
    {
        SiteCategory::create([
            'name' => 'Über uns',
            'url' => 'über_uns'
        ]);

        SiteCategory::create([
            'name' => 'SGA',
            'url' => 'sga'
        ]);

        SiteCategory::create([
            'name' => 'Information',
            'url' => 'info'
        ]);

        SiteCategory::create([
            'name' => 'Impressum',
            'url' => 'impressum'
        ]);
    }
}
