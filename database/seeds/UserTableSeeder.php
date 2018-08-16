<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
          'name' => 'Michael Lackner',
          'email' => 'miclack30@gmail.com',
          'password' => bcrypt('121212'),
        ]);
        $admin = App\Role::first();
        $user->roles()->save($admin);

        // User::create([
        //   'name' => 'Franz Maier',
        //   'email' => 'franzmaier@gmail.com',
        //   'password' => bcrypt('121212'),
        // ]);

        // User::create([
        //   'name' => 'Hainz Rainmann',
        //   'email' => 'hainzrainmann@gmail.com',
        //   'password' => bcrypt('121212'),
        // ]);
    }
}
