<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
          'name' => 'Michael Lackner',
          'email' => 'miclack30@gmail.com',
          'password' => bcrypt('121212'),
        ]);

        $admin = Role::first();
        $user->roles()->save($admin);
    }
}
