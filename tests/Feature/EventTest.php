<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
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
        $response->assertOk();
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
            "event_description" => "Just a Test",
            "user_id" => "1",
            "start_date" => "2019-06-04",
            "end_date" => "2019-06-05",
        ]);
        $response->assertOk();
    }
    public function testUpdateEvent(){
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('admin/event/edit', [
            "id" => rand(38,87),
            "event_name"=> "demo",
            "event_code"=> Str::random(5),
            "event_description"=> "dá",
            "event_start"=> "2019-07-04",
            "event_end"=> "2019-07-05",
            "join"=> "1",
            "question"=> "1",
            "reply"=> "1",
            "moderation"=> "1",
            "anonymous"=> "1",
        ]);
        $response->assertOk();
    }

    
    public function testDeleteEvent(){
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('/admin/event/delete', [
            "id" => rand(38,86),
        ]);
        $response->assertStatus(200);
    }

    public function testSearchEvent(){
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/admin/event', [
            "search" => "new",
        ]);
        $response->assertOk(200);
    }

    public function testCreateQuestion(){
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('/room', [
            "event_id"=> "33",
            "question"=> "type",
            "user_name"=> "",
        ]);
        $response->assertStatus(302);
    }
}
