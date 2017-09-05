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
        $this->call(CategoryTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(TextsTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(AnalythicsTableSeeder::class);
        $this->call(HolidayTableSeeder::class);
    }
}
