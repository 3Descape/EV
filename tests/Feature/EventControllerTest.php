<?php

namespace Tests\Feature;

use App\Event;
use Carbon\Carbon;
use Tests\TestCase;
use App\EventCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EventControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function only_future_or_past_events_are_shown()
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

        $user = (new ActAsUser())->setUpPermission('access_events')->getUser();
        $this->actingAs($user);

        $response = $this->get('/admin/veranstaltungen');

        $response->assertStatus(200);
        $response->assertDontSee('past');
        $response->assertSee('future');
    }
}
