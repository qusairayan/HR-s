<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;

class Locations extends Component
{
    public $lan, $lat, $dis, $location;
    public function render()
    {
        $locations = Location::all();
        return view('livewire.locations', compact("locations"));
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
    public function delete($id)
    {
        Location::destroy($id);
    }
    public function setDots($x, $y)
    {
        $this->lan = $x;
        $this->lat =$y;
    }
}
