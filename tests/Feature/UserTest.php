<?php

namespace Tests\Feature;

use App\Models\Application\Application;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->actingAs($this->user);
    }

    public function testCanVisitStaticPages() {
        $this->get('/')
            ->assertStatus(200)->assertSee('logout');
        $this->get('/privacy')
            ->assertStatus(200)->assertSee('logout');
        $this->get('/terms')
            ->assertStatus(200)->assertSee('logout');
        $this->get('/UT')
            ->assertStatus(200)->assertSee('logout');
    }

    public function testCanVisitDashboard()
    {
        $this->get('/dashboard')
            ->assertStatus(200);
    }

    public function testCanVisitProfile()
    {
        $this->get('/profile')
            ->assertStatus(200);
    }

    public function testCanUpdateProfile() {
        $user = User::find($this->user->id); // $user = $this->user; doesn't work...
        $newData = factory(User::class)->make(['name'=>'Different Name', 'email'=>'different@email.com']);

        $this->get('/profile');

        $this->post('/profile', [
                'name' => $newData->name,
                'email'=>$user->email
            ])->assertRedirect('/profile')->assertSessionHas('flash_notification');

        $updatedUser = User::find($user->id)->first();
        self::assertNotEquals($user->name, $updatedUser->name);
        self::assertEquals($newData->name, $updatedUser->name);

        $this->post('/profile', [
            'name' => $user->name,
            'email'=>$newData->email
        ])->assertRedirect('/profile')->assertSessionHas('flash_notification');

        $updatedUser = User::find($user->id);
        self::assertNotEquals($user->email, $newData->email);
        self::assertEquals($newData->email, $updatedUser->email);

        $this->post('/profile', [
            'name' => $user->name,
            'email'=>$user->email,
            'password'=>'newpassword',
            'password_confirmation'=>'newpassword'
        ])->assertRedirect('/profile')->assertSessionHas('flash_notification');

        $updatedUser = User::find($user->id);
        self::assertNotEquals($user->password, $updatedUser->password);
    }

    public function testInvalidProfileUpdatesAreBlocked() {
        $user = User::find($this->user->id); // $user = $this->user; doesn't work...

        $this->get('/profile');

        $this->post('/profile', [
            'name' => '',
            'email'=>$user->email
        ])->assertRedirect('/profile')->assertSessionHasErrors();

        $updatedUser = User::find($user->id);
        self::assertNotEquals($updatedUser->name, '');

        $this->post('/profile', [
            'name' => $user->name,
            'email'=> 'invalid'
        ])->assertRedirect('/profile')->assertSessionHasErrors();

        $updatedUser = User::find($user->id);
        self::assertNotEquals($updatedUser->email, 'invalid');

        $this->post('/profile', [
            'name' => $user->name,
            'email'=> $user->email,
            'password' => 'thispassword',
            'password_confirmation' => 'doesntmatch'
        ])->assertRedirect('/profile')->assertSessionHasErrors();

        $updatedUser = User::find($user->id);
        self::assertNotEquals($updatedUser->email, 'invalid');
    }


    public function testCanVisitTheirApplication() {
        $this->seed('TestingDatabaseSeeder');

        $application = factory(Application::class)->create(['user_id'=>$this->user->id]);

        $this->get('/UT/'.$application->id)
            ->assertStatus(200);
    }
}
