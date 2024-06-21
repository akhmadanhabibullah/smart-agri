<?php

namespace App\Http\Controllers;

use App\Models\Location3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Dashboard3LocationController extends Controller
{
    public function index()
{
    // Initialize arrays to store extracted data
    $uniqueLocations = [];
    $datasmartirrigationUnique = [];

    // API endpoint URL
    $url = 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/SmartIrrigation';

    // Fetch data from API
    $response = Http::get($url);

    // Check if request was successful
    if ($response->successful()) {
        // Decode JSON response
        $datasmartirrigation = json_decode($response->body());

        // Extract and process unique location data
        foreach ($datasmartirrigation as $data3) {
            if ($data3->longitude != 0 && $data3->latitude != 0) {
                $locationKey = $data3->latitude . ',' . $data3->longitude;
                if (!array_key_exists($locationKey, $uniqueLocations)) {
                    $uniqueLocations[$locationKey] = true;
                    $datasmartirrigationUnique[] = $data3;
                }
            }
        }

        // Sort data by TimeStamp (assuming TimeStamp is a valid field in $datasmartirrigationUnique)
        usort($datasmartirrigationUnique, function($a, $b) {
            return strtotime($a->TimeStamp) <=> strtotime($b->TimeStamp);
        });

        // Pass data to the view
        return view('dashboard.location-3.index', [
            'datasmartirrigation' => $datasmartirrigationUnique,
            'longitude' => array_column($datasmartirrigationUnique, 'longitude'),
            'latitude' => array_column($datasmartirrigationUnique, 'latitude')
        ]);
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
        $location3 = null;
        foreach ($datasmartirrigation as $data3) {
            if ($data3->TS == $ts) {
                $location3 = $data3;
                break;
            }
        }
        
        // Check if location3 was found
        if ($location3) {
            // Return view with location3 details
            return view('dashboard.location-3.show', compact('location3'));
        } else {
            // Handle case where location3 with given TS was not found
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
    //     return view('dashboard.location-3.index', [
    //         'locations3' => Location3::all(),
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('dashboard.location-3.create', [
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
    //         'name' => 'required',
    //         'address' => 'required',
    //         'latitude' => 'required',
    //         'longitude' => 'required',
    //     ]);

    //     Location3::create($validatedData);

    //     return redirect('/dashboard/location-3')->with('success','Lokasi baru telah ditambahkan');
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location3  $location3
     * @return \Illuminate\Http\Response
     */
    // public function show(Location3 $location3, $idLocation)
    // {
    //     $location3 = Location3::findOrFail($idLocation);
    //         return view('dashboard.location-3.show', compact('location3'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location3  $location3
     * @return \Illuminate\Http\Response
     */
    // public function edit(Location3 $location3, $idLocation)
    // {
    //     $location3 = Location3::findOrFail($idLocation);
    //         return view('dashboard.location-3.edit', compact('location3'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location3  $location3
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

    //     Location3::where('idLocation', $idLocation)
    //         ->update($validatedData);

    //     return redirect('/dashboard/location-3')->with('success','Data lokasi telah diperbarui');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location3  $location3
     * @return \Illuminate\Http\Response
     */
    // public function destroy($idLocation)
    // {
    //     Location3::destroy($idLocation);

    //     return redirect('/dashboard/location-3')->with('success','Data lokasi telah dihapus');
    // }
}
