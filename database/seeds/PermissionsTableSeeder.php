<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'administrator',
            'label' => 'Ist der Superuser und darf alles.'
        ]);

        $role->permissions()->create([
            'name' => 'admin',
            'label' => 'Administrator',
        ]);

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
            'name' => 'access_dashboard',
            'label' => 'Dashboard',
        ]);

        Permission::create([
            'name' => 'access_roles',
            'label' => 'Berechtigungen',
        ]);

        Permission::create([
            'name' => 'access_holiday',
            'label' => 'Ferien und schulautonome Tage',
        ]);

        Permission::create([
            'name' => 'access_files',
            'label' => 'Kann Dateien für den Download verwalten',
        ]);

    }
}
