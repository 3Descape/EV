<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'name' => Role::ADMIN_ROLE_NAME,
            'label' => 'Ist der Superuser und darf alles.'
        ]);
    }
}
