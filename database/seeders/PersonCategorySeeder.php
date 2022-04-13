<?php

namespace Database\Seeders;

use App\Models\PersonCategory;
use Illuminate\Database\Seeder;

class PersonCategorySeeder extends Seeder
{
    public function run()
    {
        PersonCategory::create([
            'name' => 'sga',
            'has_image' => true
        ]);

        PersonCategory::create([
            'name' => 'ev',
            'has_image' => false
        ]);

        PersonCategory::create([
            'name' => 'vorstand',
            'has_image' => true
        ]);
    }
}
