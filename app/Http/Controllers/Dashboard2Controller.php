<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Measurement2;
use App\Models\Location2;

class Dashboard2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations2 = Location2::all();
        $measurements2 = Measurement2::all();

        $ph = Measurement2::orderBy('idMeasurement', 'DESC')->value('ph');
        if ($ph !== null) {
            if ($ph < 5) {
                $phIndicator = "Bad";
            } else if ($ph >= 5 && $ph <= 5.5) {
                $phIndicator = "Good";
            } else if ($ph > 5.5 && $ph <= 7.5) {
                $phIndicator = "Best";
            } else {
                $phIndicator = "Out of range";
            }
        } else {
            // Handle case where there's no data available or the ph value is null
            $phIndicator = "No Data"; // or any other appropriate value
        }
        
        $moisture = Measurement2::orderBy('idMeasurement', 'DESC')->value('moisture');
        if ($moisture !== null) {
            if ($moisture < 30) {
                $moistureIndicator = "Bad";
            } else if ($moisture >= 30 && $moisture <= 33) {
                $moistureIndicator = "Good";
            } else if ($moisture > 33) {
                $moistureIndicator = "Best";
            } else {
                $moistureIndicator = "Out of range";
            }
        } else {
            // Handle case where there's no data available or the ph value is null
            $moistureIndicator = "No Data"; // or any other appropriate value
        }

        $nitrogen = Measurement2::orderBy('idMeasurement', 'DESC')->value('nitrogen');
        if ($nitrogen !== null) {
            if ($nitrogen < 0.10) {
                $nitrogenIndicator = "Very Low";
            } else if ($nitrogen >= 0.10 && $nitrogen <= 0.20) {
                $nitrogenIndicator = "Low";
            } else if ($nitrogen > 0.21 && $nitrogen <= 0.50) {
                $nitrogenIndicator = "Average";
            } else if ($nitrogen > 0.51 && $nitrogen <= 0.75) {
                $nitrogenIndicator = "High";
            } else if ($nitrogen > 0.75) {
                $nitrogenIndicator = "Very High";
            } else {
                $nitrogenIndicator = "Out of range";
            }
        } else {
            // Handle case where there's no data available or the nitrogen value is null
            $nitrogenIndicator = "No Data"; // or any other appropriate value
        }

        $phosporus = Measurement2::orderBy('idMeasurement', 'DESC')->value('phosporus');
        if ($phosporus !== null) {
            if ($phosporus < 0.021) {
                $phosporusIndicator = "Very Low";
            } else if ($phosporus >= 0.021 && $phosporus <= 0.039) {
                $phosporusIndicator = "Low";
            } else if ($phosporus >= 0.040 && $phosporus <= 0.060) {
                $phosporusIndicator = "Average";
            } else if ($phosporus >= 0.061 && $phosporus <= 0.1) {
                $phosporusIndicator = "High";
            } else if ($phosporus > 0.1) {
                $phosporusIndicator = "Very High";
            } else {
                $phosporusIndicator = "Out of range";
            }
        } else {
            // Handle case where there's no data available or the phosporus value is null
            $phosporusIndicator = "No Data"; // or any other appropriate value
        }

        $potassium = Measurement2::orderBy('idMeasurement', 'DESC')->value('potassium');
        if ($potassium !== null) {
            if ($potassium < 0.10) {
                $potassiumIndicator = "Very Low";
            } else if ($potassium >= 0.10 && $potassium <= 0.20) {
                $potassiumIndicator = "Low";
            } else if ($potassium >= 0.21 && $potassium <= 0.50) {
                $potassiumIndicator = "Average";
            } else if ($potassium >= 0.51 && $potassium <= 1) {
                $potassiumIndicator = "High";
            } else if ($potassium > 1) {
                $potassiumIndicator = "Very High";
            } else {
                $potassiumIndicator = "Out of range";
            }
        } else {
            // Handle case where there's no data available or the potassium value is null
            $potassiumIndicator = "No Data"; // or any other appropriate value
        }

        return view('dashboard/dashboard-2.index')->with(compact(
            'locations2',
            'measurements2',
            'ph',
            'phIndicator',
            'moisture',
            'moistureIndicator',
            'nitrogen',
            'nitrogenIndicator',
            'phosporus',
            'phosporusIndicator',
            'potassium',
            'potassiumIndicator',
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
