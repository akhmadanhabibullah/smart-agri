<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Http;

class DashboardMeasurementController extends Controller
{   


// public function index() // WITHOUT CONVERTING TIMESTAMP FORMAT UNIFORMLY
// {
//     // Initialize arrays to store extracted data
//     $temperature = [];
//     $ph = [];
//     $moisture = [];
//     $nitrogen = [];
//     $fosfor = [];
//     $kalium = [];
//     $conductivity = [];
    
//     // API endpoint URL
//     $url = 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/AllDataSmartSoil';
    
//     // Fetch data from API
//     $response = Http::get($url);
    
//     // Check if request was successful
//     if ($response->successful()) {
//         // Decode JSON response
//         $datasmartsoil1 = json_decode($response->body());
        
//         // Format the timestamps to uniform format for sorting
//         foreach ($datasmartsoil1 as $data1) {
//             // Parse the original format "Friday, 14/06/2024 23:21:00" and format into "Fri Jun 14 12:58:59 2024"
//             $parsedTime = \DateTime::createFromFormat('l, d/m/Y H:i:s', $data1->TimeStamp);
//             if ($parsedTime) {
//                 $data1->TimeStamp = $parsedTime->format('D M d H:i:s Y');
//             } else {
//                 // Handle parsing error, if any
//                 $data1->TimeStamp = null; // Or any fallback value
//             }
            
//             $temperature[] = $data1->temperature;
//             $ph[] = $data1->ph;
//             $moisture[] = $data1->moisture;
//             $nitrogen[] = $data1->nitrogen;
//             $fosfor[] = $data1->fosfor;
//             $kalium[] = $data1->kalium;
//             $conductivity[] = $data1->conductivity;
//         }
        
//         // Sort data by date then time ascending
//         usort($datasmartsoil1, function($a, $b) {
//             // Convert dates to Unix timestamps for comparison
//             $timeA = strtotime($a->TimeStamp);
//             $timeB = strtotime($b->TimeStamp);
            
//             // Compare timestamps
//             if ($timeA == $timeB) {
//                 return 0;
//             }
//             return ($timeA < $timeB) ? -1 : 1;
//         });
        
//         // Pass sorted and formatted data to the view
//         return view('dashboard.measurement.index', compact('datasmartsoil1', 'temperature', 'ph', 'moisture', 'nitrogen', 'fosfor', 'kalium', 'conductivity'));
//     } else {
//         // Handle API request failure (e.g., log error, show error message)
//         abort(500, 'Failed to fetch data from API');
//     }
// }

public function index()
{
    // Initialize arrays to store extracted data
    $temperature = [];
    $ph = [];
    $moisture = [];
    $nitrogen = [];
    $fosfor = [];
    $kalium = [];
    $conductivity = [];
    
    // API endpoint URL
    $url = 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/AllDataSmartSoil';
    
    // Fetch data from API
    $response = Http::get($url);
    
    // Check if request was successful
    if ($response->successful()) {
        // Decode JSON response
        $datasmartsoil1 = json_decode($response->body());
        
        // Format the timestamps to uniform format for sorting
        foreach ($datasmartsoil1 as $data1) {
            // Parse the original format "Friday, 14/06/2024 23:21:00" and format into "Fri Jun 14 12:58:59 2024"
            $parsedTime = \DateTime::createFromFormat('l, d/m/Y H:i:s', $data1->TimeStamp);
            if ($parsedTime) {
                $data1->TimeStamp = $parsedTime->format('D M d H:i:s Y');
            } else {
                // Handle parsing error, if any
                $data1->TimeStamp = null; // Or any fallback value
            }
            
            $temperature[] = $data1->temperature;
            $ph[] = $data1->ph;
            $moisture[] = $data1->moisture;
            $nitrogen[] = $data1->nitrogen;
            $fosfor[] = $data1->fosfor;
            $kalium[] = $data1->kalium;
            $conductivity[] = $data1->conductivity;
        }
        
        // Sort data by date then time ascending
        usort($datasmartsoil1, function($a, $b) {
            // Convert dates to Unix timestamps for comparison
            $timeA = strtotime($a->TimeStamp);
            $timeB = strtotime($b->TimeStamp);
            
            // Compare timestamps
            if ($timeA == $timeB) {
                return 0;
            }
            return ($timeA < $timeB) ? -1 : 1;
        });
        
        // Pass sorted and formatted data to the view
        return view('dashboard.measurement.index', compact('datasmartsoil1', 'temperature', 'ph', 'moisture', 'nitrogen', 'fosfor', 'kalium', 'conductivity'));
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
        $measurement = null;
        foreach ($datasmartsoil1 as $data2) {
            if ($data2->TS == $ts) {
                $measurement = $data2;
                break;
            }
        }
        
        // Check if measurement was found
        if ($measurement) {
            // Return view with measurement details
            return view('dashboard.measurement.show', compact('measurement'));
        } else {
            // Handle case where measurement with given TS was not found
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
    //     $measurements = Measurement::join('locations', 'measurements.idLocation', '=', 'locations.idLocation')
    //         ->orderBy('measurements.idMeasurement', 'asc')
    //         ->get(['measurements.*', 'locations.latitude', 'locations.longitude', 'locations.altitude']);
    
    //     return view('dashboard.measurement.index', compact('measurements'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Measurement $measurement)
    // {
    //     return view('dashboard.measurement.create', [
    //         'measurement' => $measurement,
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
    //         'temperature' => 'required',
    //         'ph' => 'required',
    //         'moisture' => 'required',
    //         'nitrogen' => 'required',
    //         'phosporus' => 'required',
    //         'potassium' => 'required',
    //         'ec' => 'required',
    //         'idLocation' => 'required',
    //     ]);

    //     $validatedData['idMeasurement'] = auth()->user()->id;

    //     Measurement::create($validatedData);

    //     return redirect('/dashboard/measurement')->with('success','Pengukuran baru telah ditambahkan');
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    // public function show(Measurement $measurement)
    // {
    //     return view('dashboard.measurement.show', 
    //     [
    //         'measurement' => $measurement,
    //         'locations' => Location::all()
    //     ]);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    // public function edit(Measurement $measurement)
    // {
    //     return view('dashboard.measurement.edit', [
    //         'measurement' => $measurement,
    //         'location' => Location::all()
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Measurement $measurement)
    // {
    //     $validatedData = $request->validate([
    //         'temperature' => 'required',
    //         'ph' => 'required',
    //         'moisture' => 'required',
    //         'nitrogen' => 'required',
    //         'phosporus' => 'required',
    //         'potassium' => 'required',
    //         'ec' => 'required',
    //         'idLocation' => 'required',
    //     ]);

    //     Measurement::where('idMeasurement', $measurement->idMeasurement)
    //         ->update($validatedData);

    //     return redirect('/dashboard/measurement')->with('success','Data pengukuran telah diperbarui');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Measurement $measurement)
    // {
    //     Measurement::destroy($measurement->idMeasurement);

    //     return redirect('/dashboard/measurement')->with('success','Data pengukuran telah dihapus');
    // }

    // public function getLocationDetails(Request $request, $idLocation)
    // {
    //     // Fetch the location based on the selected ID Location
    //     $location = Location::where('idLocation', $idLocation)->first();
    
    //     // Return latitude and longitude in JSON format
    //     return response()->json([
    //         'latitude' => $location->latitude,
    //         'longitude' => $location->longitude,
    //         'altitude' => $location->altitude,
    //     ]);
    // }
    
    // public function getDetails(Request $request, $idLocation)
    // {
    //     // Fetch the location based on the selected ID Location
    //     $location = Location::where('idLocation', $idLocation)->first();
    
    //     // Return the latitude in JSON format
    //     return response()->json(['latitude' => $location->longitude]);

        
    // }
}
