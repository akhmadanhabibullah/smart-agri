<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Measurement;
use App\Models\Measurement2;
use App\Models\Measurement3;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urls = [
            'smartsoil1' => 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/AllDataSmartSoil',
            'smartsoil2' => 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/NPK',
            'smartirrigation' => 'https://mhj6nk8m26.execute-api.ap-southeast-2.amazonaws.com/Development/SmartIrrigation'
        ];

        // Initialize variables for indicators
        $datasmartsoil1 = $datasmartsoil2 = $datasmartirrigation = null;
        $temperature = $ph = $moisture = $nitrogen = $phosporus = $potassium = $ec = $distance = $flowRate = $rainFall = null;

        // Fetch and process data for each API
        foreach ($urls as $key => $url) {
            $response = Http::get($url);
            if ($response->successful()) {
                $data = json_decode($response->body());

                if ($key == 'smartsoil1') {
                    // Process datasmartsoil1
                    foreach ($data as $item) {
                        $parsedTime = \DateTime::createFromFormat('l, d/m/Y H:i:s', $item->TimeStamp);
                        if ($parsedTime) {
                            $item->TimeStamp = $parsedTime->format('D M d H:i:s Y');
                        } else {
                            $item->TimeStamp = null;
                        }
                    }
                    usort($data, function($a, $b) {
                        return strtotime($a->TimeStamp) - strtotime($b->TimeStamp);
                    });
                    $datasmartsoil1 = $data;
                    $latestMeasurement = end($datasmartsoil1);
                    if ($latestMeasurement) {
                        $temperature = $latestMeasurement->temperature ?? null;
                        $ph = $latestMeasurement->ph ?? null;
                        $moisture = $latestMeasurement->moisture ?? null;
                        $nitrogen = $latestMeasurement->nitrogen ?? null;
                        $phosporus = $latestMeasurement->fosfor ?? null;
                        $potassium = $latestMeasurement->kalium ?? null;
                        $ec = $latestMeasurement->conductivity ?? null;
                    }
                } elseif ($key == 'smartsoil2') {
                    // Process datasmartsoil2
                    usort($data, function($a, $b) {
                        return strtotime($a->TimeStamp) <=> strtotime($b->TimeStamp);
                    });
                    $datasmartsoil2 = $data;
                    $latestMeasurement = end($datasmartsoil2);
                    if ($latestMeasurement) {
                        $ph = $latestMeasurement->ph ?? null;
                        $moisture = $latestMeasurement->kelembapan ?? null;
                        $nitrogen = $latestMeasurement->nitrogen ?? null;
                        $phosporus = $latestMeasurement->phosporus ?? null;
                        $potassium = $latestMeasurement->kalium ?? null;
                    }
                } elseif ($key == 'smartirrigation') {
                    // Process datasmartirrigation
                    usort($data, function($a, $b) {
                        return $a->TS - $b->TS;
                    });
                    $datasmartirrigation = $data;
                    $latestMeasurement = end($datasmartirrigation);
                    if ($latestMeasurement) {
                        $distance = $latestMeasurement->jarak ?? null;
                        $flowRate = $latestMeasurement->{'flow rate'} ?? null;
                        $rainFall = $latestMeasurement->{'curah hujan'} ?? null;
                    }
                }
            } else {
                abort(500, 'Failed to fetch data from API: ' . $key);
            }
        }

        // Return combined view with all measurements
        return view('dashboard.index')->with(compact(
            'temperature',
            'ph',
            'moisture',
            'nitrogen',
            'phosporus',
            'potassium',
            'ec',
            'distance',
            'flowRate',
            'rainFall',
            'datasmartsoil1',
            'datasmartsoil2',
            'datasmartirrigation'
        ));

        // $measurements = Measurement::all();
        // $measurements2 = Measurement2::all();
        // $measurements3 = Measurement3::all();

        // return view('dashboard.index')->with(compact('measurements', 'measurements2', 'measurements3'));
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
