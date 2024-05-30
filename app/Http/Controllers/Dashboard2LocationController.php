<?php

namespace App\Http\Controllers;

use App\Models\Location2;
use Illuminate\Http\Request;

class Dashboard2LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.location-2.index', [
            'locations2' => Location2::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.location-2.create', [
            'locations2' => Location2::all()
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

        Location2::create($validatedData);

        return redirect('/dashboard/location-2')->with('success','Lokasi baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location2  $location2
     * @return \Illuminate\Http\Response
     */
    public function show(Location2 $location2, $idLocation)
    {
        $location2 = Location2::findOrFail($idLocation);
            return view('dashboard.location-2.show', compact('location2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location2  $location2
     * @return \Illuminate\Http\Response
     */
    public function edit(Location2 $location2, $idLocation)
    {
        $location2 = Location2::findOrFail($idLocation);
            return view('dashboard.location-2.edit', compact('location2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location2  $location2
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

        Location2::where('idLocation', $idLocation)
            ->update($validatedData);

        return redirect('/dashboard/location-2')->with('success','Data lokasi telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location2  $location2
     * @return \Illuminate\Http\Response
     */
    public function destroy($idLocation)
    {
        Location2::destroy($idLocation);

        return redirect('/dashboard/location-2')->with('success','Data lokasi telah dihapus');
    }
}
