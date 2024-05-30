<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;
use App\Models\Measurement;

class LiveDashboardChart extends Component
{
    public $selectedLocation;
    public $locations;
    public $measurements;

    public function mount()
    {
        $this->locations = Location::all();
        $this->selectedLocation = $this->locations->first()->idLocation; // Set the default selected location
        $this->loadMeasurements();
    }

    public function loadMeasurements()
    {
        $this->measurements = Measurement::where('idLocation', $this->selectedLocation)->get();
    }

    // public function mount()
    // {
    //     $measurements = Measurement::latest()->limit(10)->get();
    //     foreach($measurements as $measurement){
    //         $data['label'][] = $measurement->created_at->format('H:i:s');
    //         $data['data'][] = (int)$measurement->temperature;
    //     }
    //     $this->measurements = json_encode($data);
    //     dd($this->measurements);
    // }

    public function render()
    {
        return view('dashboard.index');
    }
}
