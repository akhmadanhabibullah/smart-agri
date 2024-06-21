<?php

namespace App\Http\Controllers;

use App\Models\Measurement3;
use Illuminate\Http\Request;
use App\Models\Location3;
use Illuminate\Support\Facades\Http;


class Dashboard3MeasurementController extends Controller
{
    public function index()
    {
    // Initialize arrays to store extracted data
    $distance = [];
    $flowRate = [];
    $rainFall = [];
    
    // API endpoint URL
    $url = 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/SmartIrrigation';
    
    // Fetch data from API
    $response = Http::get($url);
    
    // Check if request was successful
    if ($response->successful()) {
        // Decode JSON response
        $datasmartirrigation = json_decode($response->body());
        
        // Extract and process data
        foreach ($datasmartirrigation as $data3) {
            $distance[] = $data3->jarak;
            $flowRate[] = $data3->{'flow rate'};
            $rainFall[] = $data3->{'curah hujan'};
        }
        
        // Sort data by TimeStamp (assuming TimeStamp is a valid field in $datasmartirrigation)
        usort($datasmartirrigation, function($a, $b) {
            return strtotime($a->TimeStamp) <=> strtotime($b->TimeStamp);
        });
        
        // Pass data to the view
        return view('dashboard.measurement-3.index', compact('datasmartirrigation', 'distance', 'flowRate', 'rainFall'));
    } else {
        // Handle API request failure (e.g., log error, show error message)
        abort(500, 'Failed to fetch data from API');
    }
}

    public function show($ts)
    {
    // API endpoint URL to fetch data
    $url = 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/SmartIrrigation';

    // Fetch data from API
    $response = Http::get($url);

    // Check if request was successful
    if ($response->successful()) {
        // Decode JSON response
        $datasmartirrigation = json_decode($response->body());
        
        // Find the measurement with matching TS
        $measurement3 = null;
        foreach ($datasmartirrigation as $data3) {
            if ($data3->TS == $ts) {
                $measurement3 = $data3;
                break;
            }
        }
        
        // Check if measurement3 was found
        if ($measurement3) {
            // Return view with measurement3 details
            return view('dashboard.measurement-3.show', compact('measurement3'));
        } else {
            // Handle case where measurement3 with given TS was not found
            abort(404, 'Measurement not found');
        }
    } else {
        // Handle API request failure (e.g., log error, show error message)
        abort(500, 'Failed to fetch data from API');
    }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $measurements3 = Measurement3::join('locations3', 'measurements3.idLocation', '=', 'locations3.idLocation')
    //         ->orderBy('measurements3.idMeasurement', 'asc')
    //         ->get(['measurements3.*', 'locations3.latitude', 'locations3.longitude']);

    //     return view('dashboard.measurement-3.index', compact('measurements3'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Measurement3 $measurement3)
    // {
    //     return view('dashboard.measurement-3.create', [
    //         'measurement3' => $measurement3,
    //         'locations3' => Location3::all()
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'distance' => 'required',
    //         'flowRate' => 'required',
    //         'rainFall' => 'required',
    //         'idLocation' => 'required',
    //     ]);

    //     $validatedData['idMeasurement'] = auth()->user()->id;

    //     Measurement3::create($validatedData);

    //     return redirect('/dashboard/measurement-3')->with('success', 'Pengukuran baru telah ditambahkan');
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Measurement3  $measurement3
     * @return \Illuminate\Http\Response
     */
    // public function show(Measurement3 $measurement3, $idLocation)
    // {
    //     $measurement3 = Measurement3::findOrFail($idLocation);
    //     $location3 = Location3::findOrFail($measurement3->idLocation);

    //     return view('dashboard.measurement-3.show', compact('measurement3', 'location3'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Measurement3  $measurement3
     * @return \Illuminate\Http\Response
     */
    // public function edit(Measurement3 $measurement3, $idMeasurement)
    // {
    //     $measurement3 = Measurement3::findOrFail($idMeasurement);

    //     // Find the associaÍted location using the idLocation from the measurement
    //     $location3 = Location3::all();
    //     return view('dashboard.measurement-3.edit', compact('measurement3', 'location3'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Measurement3  $measurement3
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $idMeasurement)
    // {
    //     $validatedData = $request->validate([
    //         'distance' => 'required',
    //         'flowRate' => 'required',
    //         'rainFall' => 'required',
    //         'idLocation' => 'required',
    //     ]);

    //     Measurement3::where('idMeasurement', $idMeasurement)
    //         ->update($validatedData);

    //     return redirect('/dashboard/measurement-3')->with('success', 'Data pengukuran telah diperbarui');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Measurement3  $measurement3
     * @return \Illuminate\Http\Response
     */


    // public function destroy($idMeasurement)
    // {
    //     Measurement3::destroy($idMeasurement);
    //     return redirect('/dashboard/measurement-3')->with('success', 'Data pengukuran telah dihapus');
    // }

    // public function getLocationDetails(Request $request, $idLocation)
    // {
    //     // Fetch the location based on the selected ID Location
    //     $location3 = Location3::where('idLocation', $idLocation)->first();

    //     // Return latitude and longitude in JSON format
    //     return response()->json([
    //         'latitude' => $location3->latitude,
    //         'longitude' => $location3->longitude,
    //     ]);
    // }

    // public function getDetails(Request $request, $idLocation)
    // {
    //     // Fetch the location based on the selected ID Location
    //     $location3 = Location3::where('idLocation', $idLocation)->first();

    //     // Return the latitude in JSON format
    //     return response()->json(['latitude' => $location3->longitude]);
    // }
}
