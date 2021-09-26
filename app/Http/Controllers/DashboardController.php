<?php

namespace App\Http\Controllers;

use App\Models\Application\Application;
use App\Models\Location\State;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $applications = Application::where('user_id', Auth::id())->get();

        return view('dashboard', compact('applications'));
    }

    public function start(Request $request)
    {
        $states = State::pluck('name', 'id');
        return view('start', compact('states'));
    }

    public function spawnApplication(Request $request)
    {
        $rules = ['state_id' => 'required|exists:states,id'];
        if (config('captcha.enabled', true)) {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }

        $this->validate($request, $rules);

        $application = new Application($request->input());
        $application->user_id = Auth::id();
        $application->data = [];
        $application->save();

        $stateCode = $application->state->code();

        $redirect = "/$stateCode/$application->id";
        return redirect()->to($redirect);
    }

}
