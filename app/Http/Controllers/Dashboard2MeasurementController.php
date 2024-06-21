<?php

namespace App\Http\Controllers;

use App\Models\Measurement2;
use Illuminate\Http\Request;
use App\Models\Location2;
use Illuminate\Support\Facades\Http;

class Dashboard2MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    // Initialize arrays to store extracted data
    $ph = [];
    $kelembapan = [];
    $nitrogen = [];
    $phosporus = [];
    $kalium = [];
    
    // API endpoint URL
    $url = 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/NPK';
    
    // Fetch data from API
    $response = Http::get($url);
    
    // Check if request was successful
    if ($response->successful()) {
        // Decode JSON response
        $datasmartsoil2 = json_decode($response->body());
        
        // Extract and process data
        foreach ($datasmartsoil2 as $data2) {
            $ph[] = $data2->ph;
            $kelembapan[] = $data2->kelembapan;
            $nitrogen[] = $data2->nitrogen;
            $phosporus[] = $data2->phosporus;
            $kalium[] = $data2->kalium;
        }
        
        // Sort data by TimeStamp (assuming TimeStamp is a valid field in $datasmartsoil2)
        usort($datasmartsoil2, function($a, $b) {
            return strtotime($a->TimeStamp) <=> strtotime($b->TimeStamp);
        });
        
        // Pass data to the view
        return view('dashboard.measurement-2.index', compact('datasmartsoil2', 'ph', 'kelembapan', 'nitrogen', 'phosporus', 'kalium'));
    } else {
        // Handle API request failure (e.g., log error, show error message)
        abort(500, 'Failed to fetch data from API');
    }
}

    // public function index()
    // {
    //     $measurements2 = Measurement2::join('locations2', 'measurements2.idLocation', '=', 'locations2.idLocation')
    //         ->orderBy('measurements2.idMeasurement', 'asc')
    //         ->get(['measurements2.*', 'locations2.latitude', 'locations2.longitude']);

    //     return view('dashboard.measurement-2.index', compact('measurements2'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Measurement2 $measurement2)
    // {
    //     return view('dashboard.measurement-2.create', [
    //         'measurement2' => $measurement2,
    //         'locations2' => Location2::all()
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
    //         'ph' => 'required',
    //         'moisture' => 'required',
    //         'nitrogen' => 'required',
    //         'phosporus' => 'required',
    //         'potassium' => 'required',
    //         'idLocation' => 'required',
    //     ]);

    //     $validatedData['idMeasurement'] = auth()->user()->id;

    //     Measurement2::create($validatedData);

    //     return redirect('/dashboard/measurement-2')->with('success', 'Pengukuran baru telah ditambahkan');
    // }

    public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'ph' => 'required|numeric',
        'kelembapan' => 'required|numeric',
        'nitrogen' => 'required|numeric',
        'phosporus' => 'required|numeric',
        'kalium' => 'required|numeric',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'TimeStamp' => 'required|date'
    ]);

    // API endpoint URL for posting data
    $url = 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/NPK';

    // Send POST request to the API
    $response = Http::post($url, $validatedData);

    // Check if request was successful
    if ($response->successful()) {
        // Redirect back with success message
        return redirect()->route('measurement-2.index')->with('success', 'Measurement added successfully');
    } else {
        // Handle API request failure (e.g., log error, show error message)
        return back()->withErrors('Failed to add measurement');
    }
}

    public function create()
    {
    // Return the view for creating a new measurement
    return view('dashboard.measurement-2.create');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Measurement2  $measurement2
     * @return \Illuminate\Http\Response
     */
    public function show($ts)
    {
    // API endpoint URL to fetch data
    $url = 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/NPK';
    
    // Fetch data from API
    $response = Http::get($url);
    
    // Check if request was successful
    if ($response->successful()) {
        // Decode JSON response
        $datasmartsoil2 = json_decode($response->body());
        
        // Find the measurement with matching TS
        $measurement2 = null;
        foreach ($datasmartsoil2 as $data2) {
            if ($data2->TS == $ts) {
                $measurement2 = $data2;
                break;
            }
        }
        
        // Check if measurement2 was found
        if ($measurement2) {
            // Return view with measurement2 details
            return view('dashboard.measurement-2.show', compact('measurement2'));
        } else {
            // Handle case where measurement2 with given TS was not found
            abort(404, 'Measurement not found');
        }
    } else {
        // Handle API request failure (e.g., log error, show error message)
        abort(500, 'Failed to fetch data from API');
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Measurement2  $measurement2
     * @return \Illuminate\Http\Response
     */
    // public function edit($idMeasurement)
    // {
    //     // Find the measurement by its ID
    //     $measurement2 = Measurement2::findOrFail($idMeasurement);

    //     // Find the associaÍted location using the idLocation from the measurement
    //     $location2 = Location2::all();

    //     return view('dashboard.measurement-2.edit', compact('measurement2', 'location2'));
    // }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Measurement2  $measurement2
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $idMeasurement)
    // {
    //     $validatedData = $request->validate([
    //         'ph' => 'required',
    //         'moisture' => 'required',
    //         'nitrogen' => 'required',
    //         'phosporus' => 'required',
    //         'potassium' => 'required',
    //         'idLocation' => 'required',
    //     ]);

    //     Measurement2::where('idMeasurement', $idMeasurement)
    //         ->update($validatedData);

    //     return redirect('/dashboard/measurement-2')->with('success', 'Data pengukuran telah diperbarui');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Measurement2  $measurement2
     * @return \Illuminate\Http\Response
     */
    // public function destroy($idMeasurement)
    // {
    //     Measurement2::destroy($idMeasurement);

    //     return redirect('/dashboard/measurement-2')->with('success', 'Data pengukuran telah dihapus');
    // }

    // public function getLocationDetails(Request $request, $idLocation)
    // {
    //     // Fetch the location based on the selected ID Location
    //     $location2 = Location2::where('idLocation', $idLocation)->first();

    //     // Return latitude and longitude in JSON format
    //     return response()->json([
    //         'latitude' => $location2->latitude,
    //         'longitude' => $location2->longitude,
    //     ]);
    // }

    // public function getDetails(Request $request, $idLocation)
    // {
    //     // Fetch the location based on the selected ID Location
    //     $location2 = Location2::where('idLocation', $idLocation)->first();

    //     // Return the latitude in JSON format
    //     return response()->json(['latitude' => $location2->longitude]);
    // }
}
