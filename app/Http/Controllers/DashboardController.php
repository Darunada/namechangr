<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Location\State;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest-notification');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $applications = Application::where('user_id', Auth::id())->get();
        $sessionApplication = $request->session()->get('activeApplication');
        if($sessionApplication != null) {
            $applications[] = $sessionApplication;
        }

        return view('dashboard', compact('applications'));
    }

    public function start(Request $request) {
        if(Auth::guest()) {
            $request->session()->forget('activeApplication');
        }

        $states = State::pluck('name', 'id');
        return view ('start', compact('states'));
    }

    public function spawnApplication(Request $request) {
        $this->validate($request, [
            'g-recaptcha-response' => 'required|recaptcha',
            'state_id' => 'required|exists:states,id',
        ]);

        /**
         * Because we are storing this in sessions for guest users
         * we need to make sure name_change and gender_change get a default value
         * so we can't rely on fillables completely
         */
        $app = [
            'state_id'=>$request->get('state_id'),
            'name_change'=>$request->exists('name_change'),
            'gender_change'=>$request->exists('gender_change'),
        ];

        $application = new Application($app);
        $application->user_id = Auth::id();
        $application->data = [];
        if(Auth::check()) {
            $application->save();
        } else {
            $request->session()->put('activeApplication', $application);
        }



        $stateCode = $application->state->code();

        $redirect = "/$stateCode/$application->id";
        return redirect()->to($redirect);
    }

}
