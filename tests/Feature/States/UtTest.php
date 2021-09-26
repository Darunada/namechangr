<?php

namespace Tests\Feature\States;

use App\Mail\UserRegistered as UserRegisteredEmail;
use App\Models\Location\County;
use App\Models\Location\State;
use App\Notifications\UserRegistered;
use App\User;
use Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Passport;
use Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UtTest extends TestCase
{
    use RefreshDatabase;

    public function testAnonymousUserCanVisitIndex()
    {
        $this->get('/UT')->assertStatus(200);
    }

    public function testUserCanVisitIndex()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get('/UT')->assertStatus(200);
    }

    public function testUserCanGetDistrictsFromCounty()
    {
        $this->seed('TestingDatabaseSeeder');
        $user = factory(User::class)->create();
        $county = County::where('name', 'Salt Lake')->first();

        Passport::actingAs($user);
        $this->actingAs($user)->get('/api/v1/counties/'.$county->id)->assertStatus(200);
    }
}
