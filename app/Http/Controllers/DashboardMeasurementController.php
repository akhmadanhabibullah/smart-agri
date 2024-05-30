<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use Illuminate\Http\Request;
use App\Models\Location;

class DashboardMeasurementController extends Controller
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
            ->get(['measurements.*', 'locations.latitude', 'locations.longitude', 'locations.altitude']);
    
        return view('dashboard.measurement.index', compact('measurements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Measurement $measurement)
    {
        return view('dashboard.measurement.create', [
            'measurement' => $measurement,
            'locations' => Location::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'temperature' => 'required',
            'ph' => 'required',
            'moisture' => 'required',
            'nitrogen' => 'required',
            'phosporus' => 'required',
            'potassium' => 'required',
            'ec' => 'required',
            'idLocation' => 'required',
        ]);

        $validatedData['idMeasurement'] = auth()->user()->id;

        Measurement::create($validatedData);

        return redirect('/dashboard/measurement')->with('success','Pengukuran baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function show(Measurement $measurement)
    {
        return view('dashboard.measurement.show', 
        [
            'measurement' => $measurement,
            'locations' => Location::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function edit(Measurement $measurement)
    {
        return view('dashboard.measurement.edit', [
            'measurement' => $measurement,
            'location' => Location::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Measurement $measurement)
    {
        $validatedData = $request->validate([
            'temperature' => 'required',
            'ph' => 'required',
            'moisture' => 'required',
            'nitrogen' => 'required',
            'phosporus' => 'required',
            'potassium' => 'required',
            'ec' => 'required',
            'idLocation' => 'required',
        ]);

        Measurement::where('idMeasurement', $measurement->idMeasurement)
            ->update($validatedData);

        return redirect('/dashboard/measurement')->with('success','Data pengukuran telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Measurement $measurement)
    {
        Measurement::destroy($measurement->idMeasurement);

        return redirect('/dashboard/measurement')->with('success','Data pengukuran telah dihapus');
    }

    public function getLocationDetails(Request $request, $idLocation)
    {
        // Fetch the location based on the selected ID Location
        $location = Location::where('idLocation', $idLocation)->first();
    
        // Return latitude and longitude in JSON format
        return response()->json([
            'latitude' => $location->latitude,
            'longitude' => $location->longitude,
            'altitude' => $location->altitude,
        ]);
    }
    
    public function getDetails(Request $request, $idLocation)
    {
        // Fetch the location based on the selected ID Location
        $location = Location::where('idLocation', $idLocation)->first();
    
        // Return the latitude in JSON format
        return response()->json(['latitude' => $location->longitude]);

        
    }
}
