<?php

namespace App\Http\Livewire\Locations;

use App\Models\Location;
use Livewire\Component;

class ShowEntryPage extends Component
{
    public Location $location;

    public function render()
    {
        return view('livewire.locations.entry-page');
    }
}
