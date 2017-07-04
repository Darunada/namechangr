<?php

namespace App\Http\Controllers\Api;

use App\Models\Location\County;
use App\Models\Location\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param State $state
     * @return \Illuminate\Http\Response
     */
    public function index(State $state)
    {
        return $state->counties()->get();
    }

    /**
     * Display the specified resource.
     *
     * @param State $state
     * @param County $county
     * @return \Illuminate\Http\Response
     */
    public function show(State $state, County $county)
    {
        $county->load('districts');
        return $county;
    }
}
