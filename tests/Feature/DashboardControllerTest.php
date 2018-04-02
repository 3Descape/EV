<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use App\Permission;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DashboardControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_must_sign_in_and_have_permission_to_see_admin_area()
    {
        $response = $this->get('admin');
        $response->assertStatus(302);

        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get('/admin');
        $response->assertStatus(403);

        $permission = Permission::create([
                'name' => 'any role',
                'label' => 'user has at least one role'
            ]);

        $role = Role::create([
                    'name' => 'basic user',
                    'label' => 'is not a default user'
                ]);

        $role->permissions()->save($permission);
        $user->assignRole('basic user');

        $response = $this->get('/admin');
        $response->assertStatus(200);
    }
}
