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

    public $city;

    public $selectedState;
    public function mount()
    {
        $this->experts = Expert::verified()->get();

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

    public function filter()
    {


        
        $experts = Expert::query()->verified();


        if ($this->selectedState && $this->selectedState == 'all') {
            return $this->experts = $experts->get();
        }


        if ($this->selectedState && $this->selectedState != '') {
            $experts = $experts               
                ->WhereHas('governorate', function ($query) {
                    $query->where('slug', '=', $this->selectedState);
                });
        }



        $this->experts = $experts->get();

        return $this->experts;
    }

    public function hydrate()
    {

        $this->dispatch('select2hydrate');
    }

    /**
     * Renders the Livewire component view for experts.
     *
     * This method calls the filter function to apply any necessary filters 
     * to the experts list before returning the view with the updated experts data.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {

        return view('livewire.experts', ['experts' => $this->filter()]);
    }
}
