<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\User;
class ResetPassTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowSentMailForm()
    {
        $response = $this->get('password/reset');
        $response->assertStatus(200);
    }

    public function testSendsPasswordResetEmail()
    {
        $user = factory(User::class)->create();
        $this->expectsNotification($user, ResetPassword::class);
        $response = $this->post('password/email', ['email' => $user->email]);
        $response->assertStatus(302);
    }

    public function testDoesNotSendPasswordResetEmail()
    {
        $this->doesntExpectJobs(ResetPassword::class);
        $this->post('password/email', ['email' => 'storm@email.com']);
    }
    public function testShowPasswordResetForm()
    {
        $response = $this->get('/password/reset/token');
        $response->assertStatus(200);
    }

    public function testChangesPassword()
    {
        $user = factory(User::class)->create();
        $token = Password::createToken($user);
        $response = $this->post('/password/reset', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}
