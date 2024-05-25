<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Initiative;
use Illuminate\Support\Collection;

class InitiativesPage extends Component
{
    public Collection $initiatives ;

    public string $pageTitle ;


    public function mount() {
        $this->initiatives = Initiative::with('supporters')
        ->with('supporters.media')
        ->get();

        $this->pageTitle = __('Initiatives');
    }
    public function render()

    {
        return view('livewire.initiatives-page');
    }
}
