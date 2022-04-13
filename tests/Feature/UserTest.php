<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use App\Permission;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_has_no_role_by_default()
    {
        $user = User::factory()->create();

        $this->assertEmpty($user->roles()->get());
    }

    /** @test */
    public function a_role_can_get_assigned_to_a_user()
    {
        $role1 = Role::create([
            'name' => 'admin1',
            'label' => 'Some description in here'
        ]);

        $role2 = Role::create([
            'name' => 'admin2',
            'label' => 'Some description in here'
        ]);
        $user = User::factory()->create();

        $user->assignRole('admin1');
        $user->assignRole($role2);

        $roles = User::first()->roles()->get()->toArray();
        $this->assertEquals('admin1', $roles[0]['name']);
        $this->assertEquals('admin2', $roles[1]['name']);
        $this->assertCount(2, $roles);
    }

    /** @test */
    public function assert_if_a_user_has_a_given_role()
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name' => Role::ADMIN_ROLE_NAME,
            'label' => 'Some description in here'
        ]);

        $user->assignRole($role);

        $this->assertTrue($user->isAdmin());
        $this->assertTrue($user->hasRole($role));
    }

    /** @test */
    public function assert_if_a_user_has_a_given_permission()
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

        $role->permissions()->save($permission);

        $user->assignRole('events');

        $this->assertTrue($user->hasPermission('manage events'));
    }
}
