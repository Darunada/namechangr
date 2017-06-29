<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AnonymousUserTest extends TestCase
{

    public function testAnonymousUserCanVisitDashboard()
    {
        $this->get('dashboard')
            ->assertStatus(200)
            ->assertSee('You are using a guest user and your data will not be saved!')
            ->assertSee('Start Application');
    }

}
