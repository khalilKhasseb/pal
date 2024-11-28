<?php

namespace App\Livewire;

use App\Models\Governorate;
use Livewire\Component;
use App\Models\Expert;
use App\Models\City;
class Experts extends Component
{
    public $search;
    public $experts;

    public $governorates;
    public $cities;
    public function mount()
    {
        $this->experts = Expert::all();

        $this->governorates = Governorate::all();

        $this->cities = City::all();
    }

    public function getExpertsProperty()
    {
        return Expert::where('name', 'LIKE', "%{$this->search}%")
            ->orWhere('email', 'LIKE', "%{$this->search}%")
            ->orWhere('phone', 'LIKE', "%{$this->search}%")
            ->get();
    }

    public function render()
    {
        return view('livewire.experts');
    }
}
