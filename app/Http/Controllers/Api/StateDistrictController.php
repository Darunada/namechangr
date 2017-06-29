<?php

namespace App\Http\Controllers\Api;

use App\Models\Location\State;
use App\Models\Court\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param State $state
     * @return \Illuminate\Http\Response
     */
    public function index(State $state)
    {
        return $state->districts()->get();
    }

    /**
     * Display the specified resource.
     *
     * @param State $state
     * @param District $district
     * @return \Illuminate\Http\Response
     */
    public function show(State $state, District $district)
    {
        return $district;
    }
}
