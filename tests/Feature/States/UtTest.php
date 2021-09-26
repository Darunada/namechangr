<?php

namespace Tests\Feature\States;

use App\Models\Location\County;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

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
        $this->actingAs($user)->get('/api/v1/counties/' . $county->id)->assertStatus(200);
    }
}
