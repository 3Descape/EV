<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use App\Event;
use Carbon\Carbon;
use App\Permission;
use Tests\TestCase;
use App\EventCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EventControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function only_future_events_are_shown()
    {
        $category = EventCategory::create([
            'name' => 'sport'
        ]);

        $event_past = Event::create([
            'name' => 'past',
            'event_category_id' => $category->id,
            'html' => '<strong>Some description</strong>',
            'markup' => '**Test**',
            'date' => Carbon::now()->subDay(1),
            'location' => 'at the Gym'
        ]);

        $event_future = Event::create([
            'name' => 'future',
            'event_category_id' => $category->id,
            'html' => '<strong>Some description</strong>',
            'markup' => '**Test**',
            'date' => Carbon::now()->addDay(1),
            'location' => 'at the Gym'
        ]);

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $permission = Permission::create([
                'name' => 'access_events',
                'label' => 'user has at least one role'
            ]);

        $role = Role::create([
                    'name' => 'events',
                    'label' => 'is not a default user'
                ]);

        $role->permissions()->save($permission);
        $user->assignRole('events');

        $response = $this->get('/admin/veranstaltungen');

        $response->assertStatus(200);
        $response->assertDontSee('past');
        $response->assertSee('future');
    }
}
