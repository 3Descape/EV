<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SiteCategoryTableSeeder::class);
        $this->call(SiteTableSeeder::class);
        $this->call(EventCategoriesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(PersonCategorySeeder::class);
        $this->call(PersonTableSeeder::class);
        $this->call(AnalythicsTableSeeder::class);
    }
}
