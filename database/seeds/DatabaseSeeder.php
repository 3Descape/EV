<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SiteCategoryTableSeeder::class);

        if (env('APP_ENV') !== 'production') {
            $this->call(SiteTableSeeder::class);
            $this->call(EventCategoriesTableSeeder::class);
            $this->call(EventsTableSeeder::class);
            $this->call(PersonCategorySeeder::class);
            $this->call(PersonTableSeeder::class);
            $this->call(AnalythicsTableSeeder::class);
        }
    }
}
