<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Court\Location;
use App\Models\Location\State;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param State $state
     * @return Response
     */
    public function index(Request $request)
    {
        $countyId = $request->input('county_id');
        $districtId = $request->input('district_id');

        $collection = Location::where(['county_id' => $countyId, 'district_id' => $districtId])->get();
        return $collection->values();
    }

    /**
     * Display the specified resource.
     *
     * @param State $state
     * @param Location $location
     * @return Response
     */
    public function show(State $state, Location $location)
    {
        return $location;
    }
}
