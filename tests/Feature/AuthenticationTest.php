<?php

namespace Tests\Feature;

use App\Mail\UserRegistered as UserRegisteredEmail;
use App\Notifications\UserRegistered;
use App\User;
use Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Mockery;
use Notification;
use Socialite;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanVisitRegister()
    {
        $this->get('/register')->assertStatus(200);
    }

    public function testDuplicateRegistration() {
        $user = factory(User::class)->create();

        Notification::fake();
        Event::fake();
        foreach(['/', '/register'] AS $url) {
            $this->get($url);

            $this->post('/register', [
                'name' => $user->name,
                'email' => $user->email,
                'password' => 'secret',
                'password_confirmation' => 'secret',
            ])->assertRedirect($url)->assertSessionHasErrors();

            Notification::assertNotSentTo([$user], UserRegistered::class);
            Event::assertNotDispatched(Registered::class);
        }
    }

    public function testInvalidRegistration() {
        $user = factory(User::class)->make();

        Notification::fake();
        Event::fake();

        $this->get('/register');

        $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'short',
            'password_confirmation' => 'short',
        ])->assertRedirect('/register')->assertSessionHasErrors();

        $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'unmatched',
            'password_confirmation' => 'pairs of passwords',
        ])->assertRedirect('/register')->assertSessionHasErrors();

        $this->post('/register', [
            'name' => '',
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->assertRedirect('/register')->assertSessionHasErrors();

        $this->post('/register', [
            'name' => $user->name,
            'email' => '',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])->assertRedirect('/register')->assertSessionHasErrors();

        Notification::assertNotSentTo([$user], UserRegistered::class);
        Event::assertNotDispatched(Registered::class);
    }

    public function testSuccessfulRegistration() {
        $user = factory(User::class)->make();
        $password = 'fake password';

        Notification::fake();
        Event::fake();

        $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'password_confirmation' => $password,
        ])->assertRedirect('/dashboard')->assertSessionHas('flash_notification');

        $createdUser = User::where('email', $user->email)->first();

        // Assert a notification was sent to the given user...
        Notification::assertSentTo(
            [$createdUser], UserRegistered::class
        );

        // Assert a Registered event was dispatched
        Event::assertDispatched(Registered::class, function ($e) use ($createdUser) {
            return $e->user->id === $createdUser->id;
        });

    }

    public function testRegisteredEventSendsAdminNotification() {
        $user = factory(User::class)->create();

        Mail::fake();

        event(new Registered(($user)));

        Mail::assertSent(UserRegisteredEmail::class, function (UserRegisteredEmail $mail) use ($user) {
            return $mail->user->id === $user->id;
        });
    }

    public function testUserCanVisitLogin()
    {
        $this->get('/login')->assertStatus(200);
    }

    public function testLoginPageHasForgotPasswordLink() {
        $this->get('/login')->assertSee('Forgot Your Password?');
    }

    public function testSuccessfulLoginRedirectsToDashboard()
    {
        $user = factory(User::class)->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ])->assertRedirect('/dashboard')->assertSessionHas('flash_notification');
    }

    public function testFailedLoginHasErrors()
    {
        $user = factory(User::class)->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong'
        ])->assertSessionHasErrors();
    }

    /**
     * @dataProvider socialDriverProvider
     */
    public function testCanSignInWithSocial($driver)
    {
        $this->get('login')->assertSee('Sign in with '.ucfirst($driver));
        $this->get('/auth/'.$driver)->assertRedirect(); // can I enforce where to? 'https://www.facebook.com/v2.9/dialog/oauth?scope=email&response_type=code&state=...'
    }


    public function testInvalidProvidersAreProtected()
    {
        $this->get('/auth/invalid')->assertRedirect('/login')->assertSessionHasErrors();
        $this->get('/auth/invalid/callback')->assertRedirect('/login')->assertSessionHasErrors();
    }

    /**
     * @dataProvider socialDriverProvider
     */
    public function testRegisterWithSocial($driver) {
        Notification::fake();
        Event::fake();

        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');
        $abstractUser->shouldReceive('getId')
            ->andReturn(1234567890)
            ->shouldReceive('getEmail')
            ->andReturn('social@user.com')
            ->shouldReceive('getName')
            ->andReturn('Arlette Laguiller');

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->with($driver)->andReturn($provider);

        $this->get("/auth/$driver/callback")
            ->assertRedirect('/dashboard')->assertSessionHas('flash_notification');

        $createdUser = User::where('email', 'social@user.com')->first();

        // Assert a notification was sent to the given user...
        Notification::assertSentTo(
            [$createdUser], UserRegistered::class
        );

        // Assert a Registered event was dispatched
        Event::assertDispatched(Registered::class, function ($e) use ($createdUser) {
            return $e->user->id === $createdUser->id;
        });

    }

    /**
     * @dataProvider socialDriverProvider
     */
    public function testLoginWithSocial($driver) {
        $user = factory(User::class)->create();
        $user->socialAccounts()->create([
            'provider'=>$driver,
            'provider_uid'=>1234567890
        ]);

        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');
        $abstractUser->shouldReceive('getId')
            ->andReturn(1234567890)
            ->shouldReceive('getEmail')
            ->andReturn($user->email)
            ->shouldReceive('getName')
            ->andReturn($user->name);

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->with($driver)->andReturn($provider);

        // now register the same user again and get duplicate warning
        $this->get("/auth/$driver/callback")
            ->assertRedirect('/dashboard')->assertSessionHas('flash_notification');
    }

    /**
     * @dataProvider socialDriverProvider
     */
    public function testCanLinkSocialWithExistingUser($driver) {
        $user = factory(User::class)->create();

        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');
        $abstractUser->shouldReceive('getId')
            ->andReturn(1234567890)
            ->shouldReceive('getEmail')
            ->andReturn($user->email)
            ->shouldReceive('getName')
            ->andReturn($user->name);

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->with($driver)->andReturn($provider);

        // now register the same user again and get duplicate warning
        $this->actingAs($user)->get("/auth/$driver/callback")
            ->assertRedirect('/dashboard')->assertSessionHas('flash_notification');
    }

    public function socialDriverProvider() {
        return [
            ['facebook'],
            ['twitter'],
        ];
    }


}
