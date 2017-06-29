<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCanVisitLogin()
    {
        $this->get('login')->assertStatus(200);
    }

    public function testLoginPageHasForgotPasswordLink() {
        $this->get('login')->assertSee('Forgot Your Password?');
    }

    public function testSuccessfulLoginRedirectsToDashboard()
    {
        $user = factory(User::class)->create();

        $this->post('login', [
            'email' => $user->email,
            'password' => 'secret'
        ])->assertRedirect('dashboard')->assertSessionHas('flash_notification');
    }

    public function testFailedLoginHasErrors()
    {
        $user = factory(User::class)->create();

        $this->post('login', [
            'email' => $user->email,
            'password' => 'wrong'
        ])->assertSessionHasErrors();
    }


}
