<?php

namespace Tests\Feature;

use App\Models\Application\Application;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp() {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->actingAs($this->user);
    }

    public function testCanVisitDashboard()
    {
        $this->actingAs($this->user)
            ->get('dashboard')
            ->assertStatus(200);
    }

    public function testCanVisitProfile()
    {
        $this->actingAs($this->user)
            ->get('profile')
            ->assertStatus(200);
    }


    public function testCanVisitUT()
    {
        $this
            ->get('UT')
            ->assertStatus(200);
    }

    public function testCanVisitTheirApplication() {
        $this->seed('TestingDatabaseSeeder');

        $application = factory(Application::class)->create(['user_id'=>$this->user->id]);

        $this->actingAs($this->user)->get('UT/'.$application->id)
            ->assertStatus(200);
    }



}
