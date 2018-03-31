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
        $user = factory(User::class)->create();

        $this->assertEmpty($user->roles()->get());
    }

    /** @test */
    public function a_role_can_get_assigned_to_a_user_by_its_name()
    {
        $role = Role::create([
            'name' => 'admin',
            'label' => 'Some description in here'
        ]);

        $user = factory(User::class)->create();

        $user->assignRole('admin');

        $roles = User::first()->roles()->get()->toArray();
        $this->assertEquals('admin', $roles[0]['name']);
        $this->assertCount(1, $roles);
    }

    /** @test */
    public function assert_if_a_user_has_a_given_role()
    {
        $user = factory(User::class)->create();

        $role = Role::create([
            'name' => 'admin',
            'label' => 'Some description in here'
        ]);

        $user->assignRole('admin');

        $this->assertTrue($user->hasRole('admin'));
        $this->assertTrue($user->hasRole($role));
    }

    /** @test */
    public function assert_if_a_user_has_a_given_permission()
    {
        $user = factory(User::class)->create();

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
