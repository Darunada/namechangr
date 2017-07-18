<?php

namespace Tests\Feature;

use App\Models\Application\Application;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AnonymousUserTest extends TestCase
{

    use DatabaseMigrations;

    public function testCantVisitDashboard()
    {
        $this->get('dashboard')
            ->assertRedirect('login')->assertSessionHas('flash_notification');
    }

    public function testCantVisitProfile()
    {
        $this->get('profile')
            ->assertRedirect('login')->assertSessionHas('flash_notification');
    }

    public function testCantVisitApplication() {
        $this->seed('TestingDatabaseSeeder');

        $application = factory(Application::class)->create();

        $this->get('UT/'.$application->id)
            ->assertRedirect('login')->assertSessionHas('flash_notification');
    }



}
