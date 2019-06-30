<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegisterURL()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register')->assertSee('register');
    }

    public function testUserCanRegister()
    {
        $this->assertGuest();
        $user = factory(User::class)->make();
        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'testpass',
            'password_confirmation' => 'testpass'
        ]);
        $response->assertStatus(302)->assertRedirect('/admin/home');
        $this->assertAuthenticated();
    }
    
    public function testUserRegisterFalse(){
        $this->assertGuest();
        $user = factory(User::class)->make();
        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'testtrue',
            'password_confirmation' => 'testfalse'
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}
