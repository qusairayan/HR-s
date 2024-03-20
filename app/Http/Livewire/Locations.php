<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;

class Locations extends Component
{
    public $lan, $lat, $dis, $location;
    public function render()
    {
        return view('livewire.locations');
    }
    public function create()
    {
       Location::create([
            'longitude' => $this->lan,
            'latitude' => $this->lat,
            'distance' => $this->dis,
            'location' => $this->location
        ]);
    }
}
