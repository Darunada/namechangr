<?php

namespace Tests\Feature;

use App\Models\Application\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnonymousUserTest extends TestCase
{

    use RefreshDatabase;

    public function testCanVisitStaticPages()
    {
        $this->get('/')->assertStatus(200);
        $this->get('/privacy')->assertStatus(200);
        $this->get('/terms')->assertStatus(200);
        $this->get('/UT')->assertStatus(200);
    }

    public function testCantVisitDashboard()
    {
        $this->get('/dashboard')
            ->assertRedirect('/login')->assertSessionHas('flash_notification');
    }

    public function testCantVisitProfile()
    {
        $this->get('/profile')
            ->assertRedirect('/login')->assertSessionHas('flash_notification');
    }

    public function testCantVisitApplication()
    {
        $this->seed('TestingDatabaseSeeder');

        $application = factory(Application::class)->create();

        $this->get('/UT/' . $application->id)
            ->assertRedirect('/login')->assertSessionHas('flash_notification');
    }


}
