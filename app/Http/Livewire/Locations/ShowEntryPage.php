<?php

namespace App\Http\Livewire\Locations;

use App\Models\Location;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ShowEntryPage extends Component
{
    use AuthorizesRequests;

    public Location $location;

    public function mount(Location $location)
    {
        $this->authorize('view', $location);

        $this->location = $location;
    }

    public function render()
    {
        return view('livewire.locations.entry-page');
    }
}
