<?php

namespace App\Livewire;

use Livewire\Component;
use App\Settings\SiteSetting;
use Illuminate\Support\Collection;

class Home extends Component
{

    public Collection $siteSetting;


    public function mount()
    {
        $this->siteSetting = app(SiteSetting::class)->toCollection();
    }
    public function render()
    {    
        return view('livewire.home')
            ->layout('theme.layout.app-layout');
    }
}
