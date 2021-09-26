<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\UserRegistered;
use App\User;
use App\UserSocialAccount;
use Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use InvalidArgumentException;
use Socialite;

class AuthController extends Controller
{
    protected $input;

    public function __construct()
    {
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param Request $request
     * @param $provider
     * @return Response
     */
    public function redirectToProvider(Request $request, $provider)
    {
        try {
            $request->session()->flash('oauth_redirect_url', back()->getTargetUrl());

            return Socialite::driver($provider)->redirect();
        } catch (InvalidArgumentException $e) {
            return back()->withErrors('Unable to authenticate via that provider.  Sorry!');
        }
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param string $provider
     * @param Request $request
     * @return Response
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            /** @var \Laravel\Socialite\Two\User $socialUser */
            $socialUser = Socialite::driver($provider)->user();
        } catch (InvalidArgumentException $e) {
            return redirect('login')->withErrors('Unable to authenticate via that provider!  Sorry!');
        }

        // check the database for a social account
        $authorizedUser = UserSocialAccount::where('provider', $provider)->where('provider_uid', $socialUser->getId())->first();
        if ($authorizedUser) {
            Auth::loginUsingId($authorizedUser->user_id);
            flash('Logged in successfully!')->success();
            return redirect('dashboard');
        } else {
            if (Auth::check()) {
                // The user is logged in...
                UserSocialAccount::create(['user_id' => Auth::id(), 'provider' => $provider, 'provider_uid' => $socialUser->getId()]);

                $redirect = 'dashboard';
                if ($request->session()->has('oauth_redirect_url')) {
                    $redirect = $request->session()->get('oauth_redirect_url');
                }

                flash('Your account has been linked!')->success();
                return redirect($redirect);
            } else {
                // check for the email?
                if ($socialUser->getEmail()) {
                    $existingUser = User::where('email', $socialUser->getEmail())->count();
                    if ($existingUser > 0) {
                        flash(
                            'It appears you have already created an account with another method.  Please log in before connecting your account to ' . ucfirst(
                                $provider
                            ) . '.'
                        )
                            ->error()->important();
                        return redirect('login');
                    } else {
                        // create a user
                        $name = $socialUser->getName();
                        $email = $socialUser->getEmail();
                        $newUser = User::create(compact('name', 'email'));

                        // store its social account
                        UserSocialAccount::create(
                            ['user_id' => $newUser->id, 'provider' => $provider, 'provider_uid' => $socialUser->getId()]
                        );

                        Auth::loginUsingId($newUser->id);
                        $newUser->notify(new UserRegistered());
                        flash('Account created successfully!')->success();

                        event(new Registered($newUser));
                        $newUser->notify(new UserRegistered());

                        return redirect('dashboard');
                    }
                }
            }
        }
    }

    public function handleDeauthorizeCallback($provider)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->password == null) {
                flash("You must set a password on your account before you can remove a social link.")->error();
                return redirect()->back();
            }

            $user_id = Auth::id();
            UserSocialAccount::where(['user_id' => $user_id, 'provider' => $provider])->delete();
        } else {
            if ($provider == 'facebook') {
                $secret = config('services.facebook.client_secret');
                $signed_request = $this->parse_signed_request(Input::get('signed_request'), $secret);
                if ($signed_request) {
                    UserSocialAccount::where('provider', $provider)->where('provider_uid', $signed_request->user_id)->delete();
                }
            }
            // todo others?
            return;
        }

        flash(ucfirst($provider) . ' account unlinked.')->success();
        return back();
    }

    private function parse_signed_request($signed_request)
    {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        $secret = "appsecret"; // Use your app secret here

        // decode the data
        $sig = $this->base64_url_decode($encoded_sig);
        $data = json_decode($this->base64_url_decode($payload), true);

        // confirm the signature
        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }

        return $data;
    }

    private function base64_url_decode($input)
    {
        return base64_decode(strtr($input, '-_', '+/'));
    }
}
