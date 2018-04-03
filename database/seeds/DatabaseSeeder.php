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
        $this->call(EventCategoriesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(SiteTableSeeder::class);
        $this->call(PersonCategorySeeder::class);
        $this->call(PersonTableSeeder::class);
        $this->call(AnalythicsTableSeeder::class);
    }
}
