<?php

namespace Tests\Feature;

use App\Mail\UserRegistered as UserRegisteredEmail;
use App\Notifications\UserRegistered;
use App\User;
use Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UtTest extends TestCase
{
    use DatabaseMigrations;

    public function testAnonymousUserCanVisitIndex() {
        $this->get('/UT')->assertStatus(200);
    }

    public function testUserCanVisitIndex()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get('/UT')->assertStatus(200);
    }

}
