<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(EventsTableSeeder::class);
      $this->call(PeopleTableSeeder::class);
      User::create([
        'name' => 'Michael Lackner',
        'email' => 'miclack30@gmail.com',
        'password' => bcrypt('121212'),
      ]);
    }
}
