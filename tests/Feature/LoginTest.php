<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginURL()
    {        
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('index');        
    }

    public function testCorrectData()
    {
        $this->assertGuest();
        $user = factory(User::class)->create(['password' => bcrypt('feature')]);
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'feature',
            ])
        ->assertStatus(302)->assertRedirect('/admin/home');
        $this->assertAuthenticatedAs($user);
    }

    public function testWrongData()
    {
        $user = factory(User::class)->make(['password' => bcrypt('testpass')]);
        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testBlankFields()
    {
        $user = factory(User::class)->make(['password' => bcrypt('testpass')]);
        $response = $this->from('/login')->post('/login', [
            'email' => '',
            'password' => '',
        ]);
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function testLogoutUser()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('/logout');
        $response->assertStatus(302);
        $this->assertGuest();
    }

}
