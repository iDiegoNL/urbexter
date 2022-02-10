<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ShowHomePage extends Component
{
    public Collection $locations;

    public function mount()
    {
        $this->locations = Location::query()
            ->latest()
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.home-page');
    }
}
