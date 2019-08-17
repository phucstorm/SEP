<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use App\Event;
use App\User;
use App\Question;
use App\Poll_Question;
use App\Poll_Answer;
class EventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSecurityEventURL(){
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/admin/event');
        $response->assertOk();
    }

    public function testFailGetEventURL(){
        $response = $this->get('/admin/event');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testMicrosoftURL(){
        $response = $this->get('/signin');
        $response->assertStatus(302);
    }

    public function testUpdateUserName(){
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('/user/edit/info', [
            "id" => $user->id,
            "name" => "Faker"
        ]);
        $response->assertOk();
    }

    public function testUpdateUserPass(){
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('/user/edit/password', [
            "id" => $user->id,
            "password" => bcrypt(Str::random(23))
        ]);
        $response->assertOk();
    }

    public function testCreateEvent()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('/admin/event/create', [
            "event_name" => "TestName",
            "event_description" => "Just a Test",
            "user_id" => $user->id,
            "start_date" => "2019-06-04",
            "end_date" => "2019-06-05",
        ]);
        $response->assertOk();
    }

    public function testUpdateEvent(){
        $user = factory(User::class)->create();
        $event = factory(Event::class)->create();
        $response = $this->actingAs($user)->post('admin/event/edit', [
            "id" => $event->id,
            "event_name"=> Str::random(30),
            "event_code"=> Str::random(5),
            "event_description"=> Str::random(50),
            "event_start"=> "2019-08-14T22:15",
            "event_end"=> "2019-08-20T22:15",
            "join" => 1,
            "question" => 1,    
            "reply" => 1,
            "moderation" => 0, 
            "anonymous" => 1,
        ]);
        $response->assertOk();
    }

    public function testDeleteEvent(){
        $user = factory(User::class)->create();
        $event = factory(Event::class)->create();
        $response = $this->actingAs($user)->post('/admin/event/delete', [
            "id" =>  $event->id
        ]);
        $response->assertStatus(200);
    }

    public function testSearchEvent(){
        $user = factory(User::class)->make();
        $event = factory(Event::class)->create();
        $response = $this->actingAs($user)->get('/admin/event', [
            "search" => $event->event_name,
        ]);
        $response->assertOk();
    }

    public function testQR(){
        $event = factory(Event::class)->make();
        $response = $this->assertContains('http://localhost:8000/room?room=', Event::first()->event_link);
    }

    public function testJoinEventByEventCode(){
        $event = factory(Event::class)->create();
        $response = $this->get('/room?room='.$event->event_code);
        $response->assertOk();
    }

    // Question
    public function testCreateQuestion(){
        $user = factory(User::class)->make();
        $event = factory(Event::class)->create();
        $response = $this->actingAs($user)->post('/room', [
            "event_id"=> $event->id,
            "question"=> Str::random(400),
            "user_name"=> "",
        ]);
        $response->assertStatus(302);
    }

    public function testDeleteQuestion(){
        $user = factory(User::class)->make();
        $question = factory(Question::class)->create();
        $response = $this->actingAs($user)->get('/room/question/denied/'.$question->id, [
            "id" =>  $question->id
        ]);
        $response->assertStatus(302);
    }

    public function testLikeQuestionByHost(){
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();
        $response = $this->actingAs($user)->get('/room/like/'.$question->id,[
            "id" => $question->id
        ]);
        $response->assertOk();
    }

    public function testUnLikeQuestionByHost(){
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();
        $response = $this->actingAs($user)->get('/room/unlike/'.$question->id,[
            "id" => $question->id
        ]);
        $response->assertOk();
    }

    public function testLikeQuestionByAttendee(){
        $question = factory(Question::class)->create();
        $response = $this->get('/room/guest/like/'.$question->id,[
            "id" => $question->id
        ]);
        $response->assertOk();
    }

    public function testUnLikeQuestionByAttendee(){
        $question = factory(Question::class)->create();
        $response = $this->get('/room/guest/unlike/'.$question->id,[
            "id" => $question->id
        ]);
        $response->assertOk();
    }

    public function testReplyQuestionByHost(){
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();
        $response = $this->actingAs($user)->post('/room/reply/', [
            "question-id" => $question->id,
            "reply" => Str::random(10),
        ]);
        $response->assertStatus(302);
    }

    public function testReplyQuestionByAttendee(){
        $question = factory(Question::class)->create();
        $response = $this->post('/guest/reply/', [
            "question-id" => $question->id,
            "reply" => Str::random(30),
            "username" => ""
        ]);
        $response->assertOk();
    }

    public function testModerationAcceptQuestion(){
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();
        $response = $this->actingAs($user)->get('/room/question/accept/'.$question->id,[
            "id" => $question->id
        ]);
        $response->assertStatus(302);
    }

    public function testModerationDeniedQuestion(){
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();
        $response = $this->actingAs($user)->get('/room/question/denied/'.$question->id,[
            "id" => $question->id
        ]);
        $response->assertStatus(302);
    }

    public function testCreatePollWithMulChoice(){
        $user = factory(User::class)->create();
        $event = factory(Event::class)->create();
        $response = $this->actingAs($user)->post('/admin/event/poll/create', [
            "event-id" => $event->id,
            "poll_question_content" => Str::random(40),
            "poll_answer" => [Str::random(40),Str::random(40)],
            "mul_choice" => 1,
        ]);
        $response->assertOk();
    }

    public function testCreatePollWithOneChoice(){
        $user = factory(User::class)->create();
        $event = factory(Event::class)->create();
        $response = $this->actingAs($user)->post('/admin/event/poll/create', [
            "event-id" => $event->id,
            "poll_question_content" => Str::random(40),
            "poll_answer" => [Str::random(40),Str::random(40)],
        ]);
        $response->assertOk();
    }

    public function testDeletePoll(){
        $user = factory(User::class)->create();
        $poll = factory(Poll_Question::class)->create();
        $response = $this->actingAs($user)->get('/admin/event/poll/delete/'.$poll->id,[
            "id" => $poll->id
        ]);
        $response->assertOk();
    }

    public function testVotePoll(){
        $poll = factory(Poll_Question::class)->create();
        $response = $this->post('/room/poll/vote/', [
            "poll-id" => $poll->id,
            "poll_answer" => 21
        ]);
        $response->assertOk();
    }

    public function testChangeLanguageEN(){
        $response = $this->get('/lang/en');
        $response->assertStatus(302);
    }

    public function testChangeLanguageVI(){
        $response = $this->get('/lang/vi');
        $response->assertStatus(302);
    }
}
