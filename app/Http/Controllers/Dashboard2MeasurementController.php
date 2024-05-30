<?php

namespace App\Http\Controllers;

use App\Models\Measurement2;
use Illuminate\Http\Request;
use App\Models\Location2;

class Dashboard2MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measurements2 = Measurement2::join('locations2', 'measurements2.idLocation', '=', 'locations2.idLocation')
            ->orderBy('measurements2.idMeasurement', 'asc')
            ->get(['measurements2.*', 'locations2.latitude', 'locations2.longitude']);

        return view('dashboard.measurement-2.index', compact('measurements2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Measurement2 $measurement2)
    {
        return view('dashboard.measurement-2.create', [
            'measurement2' => $measurement2,
            'locations2' => Location2::all()
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
            'ph' => 'required',
            'moisture' => 'required',
            'nitrogen' => 'required',
            'phosporus' => 'required',
            'potassium' => 'required',
            'idLocation' => 'required',
        ]);

        $validatedData['idMeasurement'] = auth()->user()->id;

        Measurement2::create($validatedData);

        return redirect('/dashboard/measurement-2')->with('success', 'Pengukuran baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Measurement2  $measurement2
     * @return \Illuminate\Http\Response
     */
    public function show(Measurement2 $measurement2, $idLocation)
    {
        $measurement2 = Measurement2::findOrFail($idLocation);
        $location2 = Location2::findOrFail($measurement2->idLocation);

        return view('dashboard.measurement-2.show', compact('measurement2', 'location2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Measurement2  $measurement2
     * @return \Illuminate\Http\Response
     */
    public function edit($idMeasurement)
    {
        // Find the measurement by its ID
        $measurement2 = Measurement2::findOrFail($idMeasurement);

        // Find the associaÍted location using the idLocation from the measurement
        $location2 = Location2::all();

        return view('dashboard.measurement-2.edit', compact('measurement2', 'location2'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Measurement2  $measurement2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idMeasurement)
    {
        $validatedData = $request->validate([
            'ph' => 'required',
            'moisture' => 'required',
            'nitrogen' => 'required',
            'phosporus' => 'required',
            'potassium' => 'required',
            'idLocation' => 'required',
        ]);

        Measurement2::where('idMeasurement', $idMeasurement)
            ->update($validatedData);

        return redirect('/dashboard/measurement-2')->with('success', 'Data pengukuran telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Measurement2  $measurement2
     * @return \Illuminate\Http\Response
     */
    public function destroy($idMeasurement)
    {
        Measurement2::destroy($idMeasurement);

        return redirect('/dashboard/measurement-2')->with('success', 'Data pengukuran telah dihapus');
    }

    public function getLocationDetails(Request $request, $idLocation)
    {
        // Fetch the location based on the selected ID Location
        $location2 = Location2::where('idLocation', $idLocation)->first();

        // Return latitude and longitude in JSON format
        return response()->json([
            'latitude' => $location2->latitude,
            'longitude' => $location2->longitude,
        ]);
    }

    public function getDetails(Request $request, $idLocation)
    {
        // Fetch the location based on the selected ID Location
        $location2 = Location2::where('idLocation', $idLocation)->first();

        // Return the latitude in JSON format
        return response()->json(['latitude' => $location2->longitude]);
    }
}
