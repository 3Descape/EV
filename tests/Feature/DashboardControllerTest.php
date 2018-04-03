<?php

namespace Tests\Feature;

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

        $user = new ActAsUser();
        $this->actingAs($user->getUser());
        $response = $this->get('/admin');
        $response->assertStatus(403);
        $user->setUpPermission('admin');
        $response = $this->get('/admin');
        $response->assertStatus(200);
    }
}
