<?php

namespace App\Http\Controllers;

use App\Models\Location2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Dashboard2LocationController extends Controller
{
    public function index()
{
    // Initialize arrays to store extracted data
    $uniqueLocations = [];
    $datasmartsoil2Unique = [];

    // API endpoint URL
    $url = 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/NPK';

    // Fetch data from API
    $response = Http::get($url);

    // Check if request was successful
    if ($response->successful()) {
        // Decode JSON response
        $datasmartsoil2 = json_decode($response->body());

        // Extract and process unique location data
        foreach ($datasmartsoil2 as $data2) {
            if ($data2->longitude != 0 && $data2->latitude != 0) {
                $locationKey = $data2->latitude . ',' . $data2->longitude;
                if (!array_key_exists($locationKey, $uniqueLocations)) {
                    $uniqueLocations[$locationKey] = true;
                    $datasmartsoil2Unique[] = $data2;
                }
            }
        }

        // Sort data by TimeStamp (assuming TimeStamp is a valid field in $datasmartsoil2Unique)
        usort($datasmartsoil2Unique, function($a, $b) {
            return strtotime($a->TimeStamp) <=> strtotime($b->TimeStamp);
        });

        // Pass data to the view
        return view('dashboard.location-2.index', [
            'datasmartsoil2' => $datasmartsoil2Unique,
            'longitude' => array_column($datasmartsoil2Unique, 'longitude'),
            'latitude' => array_column($datasmartsoil2Unique, 'latitude')
        ]);
    } else {
        // Handle API request failure (e.g., log error, show error message)
        abort(500, 'Failed to fetch data from API');
    }
}


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
        $location2 = null;
        foreach ($datasmartsoil2 as $data2) {
            if ($data2->TS == $ts) {
                $location2 = $data2;
                break;
            }
        }
        
        // Check if location2 was found
        if ($location2) {
            // Return view with location2 details
            return view('dashboard.location-2.show', compact('location2'));
        } else {
            // Handle case where location2 with given TS was not found
            abort(404, 'Location not found');
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
    //     return view('dashboard.location-2.index', [
    //         'locations2' => Location2::all(),
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('dashboard.location-2.create', [
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
    //         'name' => 'required',
    //         'address' => 'required',
    //         'latitude' => 'required',
    //         'longitude' => 'required',
    //     ]);

    //     Location2::create($validatedData);

    //     return redirect('/dashboard/location-2')->with('success','Lokasi baru telah ditambahkan');
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location2  $location2
     * @return \Illuminate\Http\Response
     */
    // public function show(Location2 $location2, $idLocation)
    // {
    //     $location2 = Location2::findOrFail($idLocation);
    //         return view('dashboard.location-2.show', compact('location2'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location2  $location2
     * @return \Illuminate\Http\Response
     */
    // public function edit(Location2 $location2, $idLocation)
    // {
    //     $location2 = Location2::findOrFail($idLocation);
    //         return view('dashboard.location-2.edit', compact('location2'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location2  $location2
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $idLocation)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required',
    //         'address' => 'required',
    //         'latitude' => 'required',
    //         'longitude' => 'required',
    //     ]);

    //     Location2::where('idLocation', $idLocation)
    //         ->update($validatedData);

    //     return redirect('/dashboard/location-2')->with('success','Data lokasi telah diperbarui');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location2  $location2
     * @return \Illuminate\Http\Response
     */
    // public function destroy($idLocation)
    // {
    //     Location2::destroy($idLocation);

    //     return redirect('/dashboard/location-2')->with('success','Data lokasi telah dihapus');
    // }
}
