<?php

namespace App\Http\Controllers;


use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $facebook = $user->socialAccount('facebook');
        $twitter = $user->socialAccount('twitter');
        return view('profile', compact('user', 'facebook', 'twitter'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $validator->sometimes('password', 'required|min:8|confirmed', function ($input) {
            return $input->password != '';
        });

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->get('name');
        $user->email = $request->get('email');

        $password = $request->get('password');
        if (!empty($password)) {
            $user->password = bcrypt($password);
        }

        $user->save();

        flash("Account updated successfully")->success();
        return back();
    }

    public function delete(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->socialAccounts()->forceDelete();
        $user->forceDelete();

        Auth::logout();
        flash("Your account has been destroyed.")->success()->important();
        return redirect('/');
    }

}
