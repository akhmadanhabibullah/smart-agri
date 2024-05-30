<?php

namespace App\Http\Controllers;

use App\Models\Highlight;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;

class DashboardHighlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $highlights = Highlight::orderBy('id', 'desc')->get();
        return view('dashboard.highlight.index')->with(compact('highlights'));
   
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
        $highlight = Highlight::findOrFail($id);
    
        // Get the current image
        $currentImage = $highlight->image;
    
        // Update the image field if a new image is uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $highlight->image = $filename;
    
            // Delete the old image if it exists
            if ($currentImage) {
                $oldImagePath = public_path('img/' . $currentImage);
                if (is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
    
        // Update other fields as needed
        $highlight->title = $request->input('title');
        
        // Save the changes to the database
        $highlight->save();
    
        // Redirect the user to the appropriate route or page
        return redirect()->route('highlight.index')->with('success', 'Highlight successfully updated.');
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
