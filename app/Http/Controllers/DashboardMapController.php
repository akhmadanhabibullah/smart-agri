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
use Illuminate\Support\Facades\Http;

class DashboardMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // API endpoints
    $urls = [
        'smartsoil1' => 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/AllDataSmartSoil',
        'smartsoil2' => 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/NPK',
        'smartirrigation' => 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/SmartIrrigation',
    ];

    // Initialize variables for storing data
    $datasmartsoil1 = [];
    $datasmartsoil2 = [];
    $datasmartirrigation = [];

    // Fetch data from APIs
    foreach ($urls as $key => $url) {
        $response = Http::get($url);
        
        if ($response->successful()) {
            $data = json_decode($response->body(), true);

            // Extract the required data based on the API source
            switch ($key) {
                case 'smartsoil1':
                    $datasmartsoil1 = array_map(function ($item) {
                        return [
                            'TS' => $item['TS'],
                            'latitude' => $item['latitude'],
                            'longitude' => $item['longitude'],
                            'temperature' => $item['temperature'],
                            'ph' => $item['ph'],
                            'moisture' => $item['moisture'],
                            'nitrogen' => $item['nitrogen'],
                            'fosfor' => $item['fosfor'],
                            'kalium' => $item['kalium'],
                            'conductivity' => $item['conductivity'],
                            // Add other necessary fields here
                        ];
                    }, $data);
                    break;

                case 'smartsoil2':
                    $datasmartsoil2 = array_map(function ($item) {
                        return [
                            'TS' => $item['TS'],
                            'latitude' => $item['latitude'],
                            'longitude' => $item['longitude'],
                            'ph' => $item['ph'],
                            'kelembapan' => $item['kelembapan'],
                            'nitrogen' => $item['nitrogen'],
                            'phosporus' => $item['phosporus'],
                            'kalium' => $item['kalium'],
                            // Add other necessary fields here
                        ];
                    }, $data);
                    break;

                case 'smartirrigation':
                    $datasmartirrigation = array_map(function ($item) {
                        return [
                            'TS' => $item['TS'],
                            'latitude' => $item['latitude'],
                            'longitude' => $item['longitude'],
                            'jarak' => $item['jarak'],
                            'flowRate' => $item['flow rate'],
                            'rainFall' => $item['curah hujan'],
                            // Add other necessary fields here
                        ];
                    }, $data);
                    break;
            }
        } else {
            // Handle API request failure (e.g., log error, show error message)
            abort(500, 'Failed to fetch data from API: ' . $url);
        }
    }

    return view('dashboard.map.index', [
        'datasmartsoil1' => $datasmartsoil1,
        'datasmartsoil2' => $datasmartsoil2,
        'datasmartirrigation' => $datasmartirrigation,
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
    public function show()
    {
    
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
