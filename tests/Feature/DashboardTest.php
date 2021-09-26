<?php

namespace Tests\Feature;

use App\Models\Application\Application;
use App\Models\Location\State;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use NoCaptcha;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;


    public function setUp(): void
    {
        parent::setUp();

        $this->seed('TestingDatabaseSeeder');

        $this->user = factory(User::class)->create();
    }

    public function testDashboardShowsApplications()
    {
        /** @var Application $application */
        $application = factory(Application::class)->create();

        $this->actingAs($application->user)
            ->get('/dashboard')
            ->assertViewHas('applications')
            ->assertSee('<div class="application-desc">New Application</div>');
    }

    public function testDashboardHasNewApplicationBtn()
    {
        $this->actingAs($this->user)
            ->get('/dashboard')
            ->assertSee('<div class="application-desc">New Application</div>');
    }

    public function testUserCanSeeStartApplication()
    {
        $this->actingAs($this->user)
            ->get('/dashboard/start')
            ->assertStatus(200);
    }

    public function testUserCanStartAnApplication()
    {
        $state = State::where('iso_3166_2', 'UT')->first();

        NoCaptcha::shouldReceive('verifyResponse')
            ->once()
            ->andReturn(true);

        $this->actingAs($this->user);
        $this->post('/dashboard/start', [
            'state_id' => $state->id,
            'name_change' => true,
            'gender_change' => true,
            'g-recaptcha-response' => 'valid'
        ])->assertRedirect("/$state->iso_3166_2/1"); // always the first
    }

    public function testUserNeedsRecaptcha()
    {
        $state = State::where('iso_3166_2', 'UT')->first();

        NoCaptcha::shouldReceive('verifyResponse')
            ->once()
            ->andReturn(false);

        $this->actingAs($this->user);
        $this->post('/dashboard/start', [
            'state_id' => $state->id,
            'name_change' => true,
            'gender_change' => true,
            'g-recaptcha-response' => 'invalid'
        ])->assertRedirect("/");
    }

    public function testNoCaptchaRedirectsOut()
    {
        $state = State::where('iso_3166_2', 'UT')->first();

        $this->actingAs($this->user);
        $this->post('/dashboard/start', [
            'state_id' => $state->id,
            'name_change' => true,
            'gender_change' => true,
        ])->assertRedirect()->assertSessionHasErrors();
    }

}
