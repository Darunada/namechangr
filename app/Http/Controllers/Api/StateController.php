<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return State::all();
    }

    /**
     * Display the specified resource.
     *
     * @param State $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        return $state;
    }
}
