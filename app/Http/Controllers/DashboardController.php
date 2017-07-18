<?php

namespace App\Http\Controllers;

use App\Models\Application\Application;
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

        return view('dashboard', compact('applications'));
    }

    public function start(Request $request) {
        $states = State::pluck('name', 'id');
        return view ('start', compact('states'));
    }

    public function spawnApplication(Request $request) {
        $this->validate($request, [
            'g-recaptcha-response' => 'required|recaptcha',
            'state_id' => 'required|exists:states,id',
        ]);

        $application = new Application($request->input());
        $application->user_id = Auth::id();
        $application->data = [];
        $application->save();

        $stateCode = $application->state->code();

        $redirect = "/$stateCode/$application->id";
        return redirect()->to($redirect);
    }

}
