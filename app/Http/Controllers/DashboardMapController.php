<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Measurement;
use App\Models\Location2;
use App\Models\Measurement2;
use App\Models\Location3;
use App\Models\Measurement3;

class DashboardMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measurements = Measurement::join('locations', 'measurements.idLocation', '=', 'locations.idLocation')
            ->orderBy('measurements.idMeasurement', 'asc')
            ->get(['measurements.*', 'locations.latitude', 'locations.longitude']);

        $locations = Location::get();
        
        $measurements2 = Measurement2::join('locations2', 'measurements2.idLocation', '=', 'locations2.idLocation')
            ->orderBy('measurements2.idMeasurement', 'asc')
            ->get(['measurements2.*', 'locations2.latitude', 'locations2.longitude']);

        $locations2 = Location2::get();

        $measurements3 = Measurement3::join('locations3', 'measurements3.idLocation', '=', 'locations3.idLocation')
            ->orderBy('measurements3.idMeasurement', 'asc')
            ->get(['measurements3.*', 'locations3.latitude', 'locations3.longitude']);

        $locations3 = Location3::get();

        return view('dashboard.map.index',[
            'locations' => $locations,
            'measurements' => $measurements,
            'locations2' => $locations2,
            'measurements2' => $measurements2,
            'locations3' => $locations3,
            'measurements3' => $measurements3,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function show(Map $map)
    {
        $measurements = Measurement::join('locations', 'measurements.idLocation', '=', 'locations.idLocation')
            ->orderBy('measurements.idMeasurement', 'asc')
            ->get(['measurements.*', 'locations.latitude', 'locations.longitude']);

        $locations = Location::get();
        
        $measurements2 = Measurement::join('locations2', 'measurements2.idLocation', '=', 'locations2.idLocation')
            ->orderBy('measurements2.idMeasurement', 'asc')
            ->get(['measurements2.*', 'locations2.latitude', 'locations2.longitude']);

        $locations2 = Location::get();

        $measurements3 = Measurement::join('locations3', 'measurements3.idLocation', '=', 'locations3.idLocation')
            ->orderBy('measurements3.idMeasurement', 'asc')
            ->get(['measurements3.*', 'locations3.latitude', 'locations3.longitude']);

        $locations3 = Location::get();

        return view('dashboard.map.index',[
            'locations' => $locations,
            'measurements' => $measurements,
            'locations2' => $locations2,
            'measurements2' => $measurements2,
            'locations3' => $locations3,
            'measurements3' => $measurements3,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function edit(Map $map)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Map $map)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        //
    }
}
