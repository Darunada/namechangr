<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location\State;
use Illuminate\Http\Response;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return State::all();
    }

    /**
     * Display the specified resource.
     *
     * @param State $state
     * @return Response
     */
    public function show(State $state)
    {
        $state->load('counties');
        return $state;
    }
}
