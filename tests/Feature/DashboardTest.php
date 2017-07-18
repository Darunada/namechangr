<?php

namespace Tests\Feature;

use App\Mail\UserRegistered as UserRegisteredEmail;
use App\Models\Application\Application;
use App\Models\Location\State;
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

class DashboardTest extends TestCase
{
    use DatabaseMigrations;

    /** @var  User */
    protected $user;

    public function setUp() {
        $this->user = factory(User::class)->create();
    }

    public function testDashboardShowsApplications() {
        $application = factory(Application::class)->create();

        $this->actingAs($application->user)
            ->get('/dashboard')
            ->assertViewHas('applications', [$application])
            ->assertSee('class="new-application"');
    }

    public function testDashboardHasNewApplicationBtn() {
        $this->actingAs($this->user)
            ->get('/dashboard')
            ->assertSee('class="new-application"');
    }

    public function testUserCanSeeStartApplication() {
        $this->actingAs($this->user)
            ->get('/dashboard/start')
            ->assertStatus(200);
    }

    public function testUserCanStartAnApplication() {
        $state = State::where('iso_3166_2', 'UT')->first();

        $this->actingAs($this->user);
        $this->post('/dashboard/start', [
            'state_id'=>$state->id,
            'name_change' => true,
            'gender_change' => true,
        ])->assertRedirect("/$state->iso_3166_2/{}");
    }

}
