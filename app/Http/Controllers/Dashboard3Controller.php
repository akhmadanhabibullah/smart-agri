<?php

namespace App\Http\Controllers;

use App\Models\Measurement3;
use Illuminate\Http\Request;

class Dashboard3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measurements = Measurement3::all();

        $distance = Measurement3::orderBy('idMeasurement', 'DESC')->value('distance');
        if ($distance !== null) {
            if ($distance >= 0 && $distance <= 100) {
                $distanceIndicator = "Height 4";
            } else if ($distance >= 101 && $distance <= 200) {
                $distanceIndicator = "Height 3";
            } else if ($distance >= 201 && $distance <= 300) {
                $distanceIndicator = "Height 2";
            } else if ($distance >= 301 && $distance <= 400) {
                $distanceIndicator = "Height 1";
            } else {
                $distanceIndicator = "Out of range";
            }
        } else {
            // Handle case where there's no data available or the distance value is null
            $distanceIndicator = "No Data"; // or any other appropriate value
        }
        
        $flowRate = Measurement3::orderBy('idMeasurement', 'DESC')->value('flowRate');
        if ($flowRate !== null) {
            if ($flowRate >= 22.6 && $flowRate <= 30) {
                $flowRateIndicator = "Very fast";
            } else if ($flowRate >= 15.1 && $flowRate <= 22.5) {
                $flowRateIndicator = "Fast";
            } else if ($flowRate >= 7.6 && $flowRate <= 15) {
                $flowRateIndicator = "Medium";
            } else if ($flowRate >= 0 && $flowRate <= 7.5) {
                $flowRateIndicator = "Slow";
            } else {
                $flowRateIndicator = "Out of range";
            }
        } else {
            // Handle case where there's no data available or the ph value is null
            $moistureIndicator = "No Data"; // or any other appropriate value
        }

        $rainFall = Measurement3::orderBy('idMeasurement', 'DESC')->value('rainFall');
        if ($rainFall !== null) {
            if ($rainFall > 500) {
                $rainFallIndicator = "Very high";
            } else if ($rainFall >= 301 && $rainFall <= 500) {
                $rainFallIndicator = "Tall";
            } else if ($rainFall >= 101 && $rainFall <= 300) {
                $rainFallIndicator = "Medium";
            } else if ($rainFall >= 0 && $rainFall <= 100) {
                $rainFallIndicator = "Low";
            } else {
                $rainFallIndicator = "Out of range";
            }
        } else {
            // Handle case where there's no data available or the ph value is null
            $rainFallIndicator = "No Data"; // or any other appropriate value
        }

        if ($distanceIndicator == "Height 1" && $flowRateIndicator == "Slow" && $rainFallIndicator == "Low" ){
            $recommendationBox = "Good (Siaga 1)";
        } else if ($distanceIndicator == "Height 2" && $flowRateIndicator == "Medium" && $rainFallIndicator == "Medium" ){
            $recommendationBox = "Medium (Siaga 2)";
        } else if ($distanceIndicator == "Height 3" && $flowRateIndicator == "Fast" && $rainFallIndicator == "Tall" ){
            $recommendationBox = "Alert (Siaga 3)";
        } else if ($distanceIndicator == "Height 4" && $flowRateIndicator == "Very fast" && $rainFallIndicator == "Very high" ){
            $recommendationBox = "Warning (Siaga 1)";
        } else{
            $recommendationBox = "Out of range";
        }

        return view('dashboard/dashboard-3.index')->with(compact(
            'measurements',
            'distance',
            'distanceIndicator',
            'flowRate',
            'flowRateIndicator',
            'rainFall',
            'rainFallIndicator',
            'recommendationBox',
        ));
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
     * @param  \App\Models\Measurement3  $measurement3
     * @return \Illuminate\Http\Response
     */
    public function show(Measurement3 $measurement3)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Measurement3  $measurement3
     * @return \Illuminate\Http\Response
     */
    public function edit(Measurement3 $measurement3)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Measurement3  $measurement3
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Measurement3 $measurement3)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Measurement3  $measurement3
     * @return \Illuminate\Http\Response
     */
    public function destroy(Measurement3 $measurement3)
    {
        //
    }
}
