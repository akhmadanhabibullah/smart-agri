<?php

namespace App\Http\Controllers;

use App\Models\Location3;
use Illuminate\Http\Request;

class Dashboard3LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.location-3.index', [
            'locations3' => Location3::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.location-3.create', [
            'locations3' => Location3::all()
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
            'name' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        Location3::create($validatedData);

        return redirect('/dashboard/location-3')->with('success','Lokasi baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location3  $location3
     * @return \Illuminate\Http\Response
     */
    public function show(Location3 $location3, $idLocation)
    {
        $location3 = Location3::findOrFail($idLocation);
            return view('dashboard.location-3.show', compact('location3'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location3  $location3
     * @return \Illuminate\Http\Response
     */
    public function edit(Location3 $location3, $idLocation)
    {
        $location3 = Location3::findOrFail($idLocation);
            return view('dashboard.location-3.edit', compact('location3'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location3  $location3
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idLocation)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        Location3::where('idLocation', $idLocation)
            ->update($validatedData);

        return redirect('/dashboard/location-3')->with('success','Data lokasi telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location3  $location3
     * @return \Illuminate\Http\Response
     */
    public function destroy($idLocation)
    {
        Location3::destroy($idLocation);

        return redirect('/dashboard/location-3')->with('success','Data lokasi telah dihapus');
    }
}
