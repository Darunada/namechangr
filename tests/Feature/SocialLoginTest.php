<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SocialLoginTest extends TestCase
{
    public function testCanSignInWithFacebook()
    {
        $this->get('login')->assertSee('Sign in with Facebook');
        $this->get('/auth/facebook')->assertRedirect();
    }

    public function testCanSignInWithTwitter()
    {
        $this->get('login')->assertSee('Sign in with Twitter');
        $this->get('/auth/twitter')->assertRedirect();
    }

    public function testInvalidProvidersAreProtected()
    {
        $this->get('/auth/invalid')->assertRedirect()->assertSessionHas('flash_notification');
    }


}
