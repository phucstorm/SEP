<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Event;
use App\User;
class EventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSecurityEventURL(){
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/admin/event');
        $response->assertStatus(200);
    }

    public function testFailGetEventURL(){
        $response = $this->get('/admin/event');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testCreateEvent()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('/admin/event/create', [
            "event_name" => "TestName",
            "event_code" => "TestCode",
            "event_description" => "Just a Test",
            "user_id" => "1",
            "start_date" => "2019-06-04",
            "end_date" => "2019-06-05",
        ]);
        $response->assertStatus(200);
    }

    // public function testEditEvent(){
    //     $user = factory(User::class)->create();
    //     $response = $this->actingAs($user)->post('/admin/event/edit', [
    //         "event_name" => "TestName01",
    //         "event_code" => "TestCode01",
    //         "event_description" => "Just a Test",
    //         "user_id" => "1",
    //         "start_date" => "2019-06-04",
    //         "end_date" => "2019-06-05",
    //     ]);
    //     $response->assertStatus(200);
    // }
}
