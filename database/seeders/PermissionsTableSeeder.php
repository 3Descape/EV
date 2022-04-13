<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        Permission::create([
            'name' => 'access_events',
            'label' => 'Veranstaltungen',
        ]);

        Permission::create([
            'name' => 'access_sites',
            'label' => 'Seiten',
        ]);

        Permission::create([
            'name' => 'access_pictures',
            'label' => 'Bilder',
        ]);

        Permission::create([
            'name' => 'access_people',
            'label' => 'Personen',
        ]);

        Permission::create([
            'name' => 'access_user',
            'label' => 'Benutzer'
        ]);

        Permission::create([
            'name' => 'access_files',
            'label' => 'Downloads',
        ]);

        Permission::create([
            'name' => 'access_fixtures',
            'label' => 'Termine',
        ]);
    }
}
