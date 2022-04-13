<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use App\Permission;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_role_has_a_permission()
    {
        $permission = Permission::create([
            'name' => 'Events',
            'label' => 'Some description in here'
        ]);

        $role = Role::create([
            'name' => 'Manage Events',
            'label' => 'Some description in here'
        ]);

        $role->permissions()->save($permission);

        $permissions = Role::first()->permissions()->get()->toArray();

        $this->assertCount(1, $permissions);
        $this->assertContains('Events', $permissions[0]);
    }

    /** @test */
    public function a_role_hasMany_users()
    {
        $user = User::factory()->create();

        $permission = Permission::create([
            'name' => 'manage events',
            'label' => 'Some description in here'
        ]);

        $role = Role::create([
            'name' => 'events',
            'label' => 'Some description in here'
        ]);
        $this->assertFalse(!!Role::first()->users()->get()->count());

        $role->permissions()->save($permission);

        $user->assignRole('events');

        $this->assertTrue(!!Role::first()->users()->get()->count());
    }
}
