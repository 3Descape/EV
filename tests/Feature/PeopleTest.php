<?php

namespace Tests\Feature;

use App\Person;
use Tests\TestCase;
use App\PeopleCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PeopleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_category_only_shows_people_that_belong_to_it()
    {
        $category1 = PeopleCategory::create([
            'name' => 'category1',
            'has_image' => false
        ]);

        $person1 = factory(Person::class)->create([
            'people_category_id' => $category1->id
        ]);

        $category2 = PeopleCategory::create([
                'name' => 'category2',
                'has_image' => false
            ]);

        $person2 = factory(Person::class)->create([
            'people_category_id' => $category2->id
        ]);

        $user = (new ActAsUser())->setUpPermission('access_people')->getUser();
        $this->actingAs($user);

        $response = $this->get('/admin/person/frontend/' . $category1->name);
        $response->assertStatus(200);
        $response->assertSee($person1->name);
        $response->assertDontSee($person2->name);
    }
}
