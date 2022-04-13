<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SiteCategoryTableSeeder::class);
        $this->call(SitesTableSeeder::class);
        $this->call(EventCategoriesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(PersonCategorySeeder::class);
        $this->call(PersonTableSeeder::class);
        $this->call(AnalyticsTableSeeder::class);
    }
}
