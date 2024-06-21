<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardLocationController extends Controller
{
    public function index()
{
    // Initialize arrays to store extracted data
    $uniqueLocations = [];
    $datasmartsoil1Unique = [];

    // API endpoint URL
    $url = 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/AllDataSmartSoil';

    // Fetch data from API
    $response = Http::get($url);

    // Check if request was successful
    if ($response->successful()) {
        // Decode JSON response
        $datasmartsoil1 = json_decode($response->body());

        // Extract and process unique location data
        foreach ($datasmartsoil1 as $data1) {
            if ($data1->longitude != 0 && $data1->latitude != 0) {
                $locationKey = $data1->latitude . ',' . $data1->longitude;
                if (!array_key_exists($locationKey, $uniqueLocations)) {
                    $uniqueLocations[$locationKey] = true;
                    $datasmartsoil1Unique[] = $data1;
                }
            }
        }

        // Sort data by TimeStamp (assuming TimeStamp is a valid field in $datasmartsoil1Unique)
        usort($datasmartsoil1Unique, function($a, $b) {
            return strtotime($a->TimeStamp) <=> strtotime($b->TimeStamp);
        });

        // Pass data to the view
        return view('dashboard.location.index', [
            'datasmartsoil1' => $datasmartsoil1Unique,
            'longitude' => array_column($datasmartsoil1Unique, 'longitude'),
            'latitude' => array_column($datasmartsoil1Unique, 'latitude')
        ]);
    } else {
        // Handle API request failure (e.g., log error, show error message)
        abort(500, 'Failed to fetch data from API');
    }
}
    public function show($ts)
    {
    // API endpoint URL to fetch data
    $url = 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/AllDataSmartSoil';
    
    // Fetch data from API
    $response = Http::get($url);
    
    // Check if request was successful
    if ($response->successful()) {
        // Decode JSON response
        $datasmartsoil1 = json_decode($response->body());
        
        // Find the measurement with matching TS
        $location = null;
        foreach ($datasmartsoil1 as $data1) {
            if ($data1->TS == $ts) {
                $location = $data1;
                break;
            }
        }
        
        // Check if location was found
        if ($location) {
            // Return view with location details
            return view('dashboard.location.show', compact('location'));
        } else {
            // Handle case where location with given TS was not found
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
    //     return view('dashboard.location.index', [
    //         'locations' => Location::all(),
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('dashboard.location.create', [
    //         'locations' => Location::all()
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
    //         'altitude' => 'required',
    //     ]);

    //     Location::create($validatedData);

    //     return redirect('/dashboard/location')->with('success','Lokasi baru telah ditambahkan');
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    // public function show(Location $location)
    // {
    //     // dd($location);
    //     return view('dashboard.location.show', 
    //     [
    //         'location' => $location
    //     ]);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    // public function edit(Location $location)
    // {
    //     return view('dashboard.location.edit', [
    //         'location' => $location,
    //         'locations' => Location::all()
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Location $location)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required',
    //         'address' => 'required',
    //         'latitude' => 'required',
    //         'longitude' => 'required',
    //         'altitude' => 'required',
    //     ]);

    //     Location::where('idLocation', $location->idLocation)
    //         ->update($validatedData);

    //     return redirect('/dashboard/location')->with('success','Data lokasi telah diperbarui');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Location  $location
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Location $location)
    // {
    //     Location::destroy($location->idLocation);

    //     return redirect('/dashboard/location')->with('success','Data lokasi telah dihapus');
    // }
}
