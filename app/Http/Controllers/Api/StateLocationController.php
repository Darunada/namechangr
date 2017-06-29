<?php

namespace App\Http\Controllers\Api;

use App\Models\Court\Location;
use App\Models\Location\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param State $state
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, State $state)
    {
        $countyId = $request->input('county_id');
        $districtId = $request->input('district_id');

        $collection = $state->locations()->get();
        return $collection->filter(function($location, $key) use ($countyId) {
            // return true if $countyId is falsey or location's county
            $keep = $countyId == false || $location->county_id == $countyId;
            return $keep;
        })->filter(function($location, $key) use ($districtId) {
            // return true if $districtId is falsey or location's district
            $keep = $districtId == false || $location->district_id == $districtId;
            return $keep;
        })->values();
    }

    /**
     * Display the specified resource.
     *
     * @param State $state
     * @param Location $location
     * @return \Illuminate\Http\Response
     */
    public function show(State $state, Location $location)
    {
        return $location;
    }
}
