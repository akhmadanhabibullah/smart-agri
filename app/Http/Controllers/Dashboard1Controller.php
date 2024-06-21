<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Measurement;
use App\Models\Location;
use Illuminate\Support\Facades\Http;

class Dashboard1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function index()
     {
         // API endpoint URL
         $url = 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/AllDataSmartSoil';
         
         // Fetch data from API
         $response = Http::get($url);
         
         // Initialize variables for indicators
         $temperature = $ph = $moisture = $nitrogen = $phosporus = $potassium = $ec = null;
         $tempIndicator = $phIndicator = $moistureIndicator = $nitrogenIndicator = $phosporusIndicator = $potassiumIndicator = $ecIndicator = "No Data";
         
         // Check if request was successful
         if ($response->successful()) {
             // Decode JSON response
             $datasmartsoil1 = json_decode($response->body());
     
             // Convert timestamps to uniform format and for sorting
             foreach ($datasmartsoil1 as $data1) {
                 // Convert "Friday, 14/06/2024 23:21:00" to "Fri Jun 14 12:58:59 2024"
                 $parsedTime = \DateTime::createFromFormat('l, d/m/Y H:i:s', $data1->TimeStamp);
                 if ($parsedTime) {
                     $data1->TimeStamp = $parsedTime->format('D M d H:i:s Y');
                 } else {
                     // Handle parsing error, if any
                     $data1->TimeStamp = null; // Or any fallback value
                 }
             }
     
             // Sort data by TimeStamp (assuming TimeStamp is a valid field in $datasmartsoil1)
             usort($datasmartsoil1, function($a, $b) {
                 return strtotime($a->TimeStamp) - strtotime($b->TimeStamp);
             });
     
             // Get the latest measurement
             $latestMeasurement = end($datasmartsoil1);
     
             if ($latestMeasurement) {
                 $temperature = $latestMeasurement->temperature ?? null;
                 $ph = $latestMeasurement->ph ?? null;
                 $moisture = $latestMeasurement->moisture ?? null;
                 $nitrogen = $latestMeasurement->nitrogen ?? null;
                 $phosporus = $latestMeasurement->fosfor ?? null;
                 $potassium = $latestMeasurement->kalium ?? null;
                 $ec = $latestMeasurement->conductivity ?? null;
     
                 // Determine indicators for each measurement
                 if ($temperature !== null) {
                     if ($temperature < 18 || $temperature > 35) {
                         $tempIndicator = "Buruk";
                     } else if ($temperature >= 18 && $temperature <= 22 || $temperature >= 32 && $temperature <= 35) {
                         $tempIndicator = "Sedang";
                     } else if ($temperature >= 22 && $temperature <= 24 || $temperature >= 29 && $temperature <= 32) {
                        $tempIndicator = "Baik";
                     } else if ($temperature >= 24 && $temperature <= 29) {
                        $tempIndicator = "Sangat Baik";
                     } else {
                        $tempIndicator = "Di luar jangkauan";
                    }
                 }
     
                 if ($ph !== null) {
                     if ($ph < 5 || $ph > 7.9) {
                         $phIndicator = "Sedang";
                     } else if ($ph >= 5 && $ph <= 5.5 || $ph >= 7.5 && $ph <= 7.9) {
                         $phIndicator = "Baik";
                     } else if ($ph > 5.5 && $ph <= 7.5) {
                         $phIndicator = "Sangat Baik";
                     } else {
                         $phIndicator = "Di luar jangkauan";
                     }
                 }
     
                 if ($moisture !== null) {
                     if ($moisture < 30 || $moisture > 90) {
                         $moistureIndicator = "Sedang";
                     } else if ($moisture >= 30 && $moisture <= 33) {
                         $moistureIndicator = "Baik";
                     } else if ($moisture > 33 && $moisture < 90) {
                         $moistureIndicator = "Sangat Baik";
                     } else {
                         $moistureIndicator = "Di luar jangkauan";
                     }
                 }
     
                 if ($nitrogen !== null) {
                     if ($nitrogen < 0.10) {
                         $nitrogenIndicator = "Sangat Rendah";
                     } else if ($nitrogen >= 0.10 && $nitrogen <= 0.20) {
                         $nitrogenIndicator = "Rendah";
                     } else if ($nitrogen > 0.21 && $nitrogen <= 0.50) {
                         $nitrogenIndicator = "Rata-rata";
                     } else if ($nitrogen > 0.51 && $nitrogen <= 0.75) {
                         $nitrogenIndicator = "Tinggi";
                     } else if ($nitrogen > 0.75) {
                         $nitrogenIndicator = "Sangat Tinggi";
                     } else {
                         $nitrogenIndicator = "Di luar jangkauan";
                     }
                 }
     
                 if ($phosporus !== null) {
                     if ($phosporus < 0.021) {
                         $phosporusIndicator = "Sangat Rendah";
                     } else if ($phosporus >= 0.021 && $phosporus <= 0.039) {
                         $phosporusIndicator = "Rendah";
                     } else if ($phosporus >= 0.040 && $phosporus <= 0.060) {
                         $phosporusIndicator = "Rata-rata";
                     } else if ($phosporus >= 0.061 && $phosporus <= 0.1) {
                         $phosporusIndicator = "Tinggi";
                     } else if ($phosporus > 0.1) {
                         $phosporusIndicator = "Sangat Tinggi";
                     } else {
                         $phosporusIndicator = "Di luar jangkauan";
                     }
                 }
     
                 if ($potassium !== null) {
                     if ($potassium < 0.10) {
                         $potassiumIndicator = "Sangat Rendah";
                     } else if ($potassium >= 0.10 && $potassium <= 0.20) {
                         $potassiumIndicator = "Rendah";
                     } else if ($potassium >= 0.21 && $potassium <= 0.50) {
                         $potassiumIndicator = "Rata-rata";
                     } else if ($potassium >= 0.51 && $potassium <= 1) {
                         $potassiumIndicator = "Tinggi";
                     } else if ($potassium > 1) {
                         $potassiumIndicator = "Sangat Tinggi";
                     } else {
                         $potassiumIndicator = "Di luar jangkauan";
                     }
                 }
     
                 if ($ec !== null) {
                     if ($ec <= 20) {
                         $ecIndicator = "Bad";
                     } else if ($ec > 20 && $ec <= 25) {
                         $ecIndicator = "Good";
                     } else {
                         $ecIndicator = "Best";
                     }
                 }
             }
         } else {
             // Handle API request failure (e.g., log error, show error message)
             abort(500, 'Failed to fetch data from API');
         }
     
         return view('dashboard/dashboard-1.index')->with(compact(
             'temperature',
             'tempIndicator',
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
             'ec',
             'ecIndicator',
             'datasmartsoil1'
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
