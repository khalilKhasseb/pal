<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expert as ExpertModel;
class Expert extends Component
{
    public $expert;
    public $local ;
    public function mount(ExpertModel $expert) {
        // dd($expert);

        $this->local = app()->getLocale();
        
    }
    public function render()
    {
        return view('livewire.expert');
    }
}
