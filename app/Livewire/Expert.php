<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expert as ExpertModel;
class Expert extends Component
{
    public function mount(ExpertModel $expert) {
        dd($expert);
    }
    public function render()
    {
        return view('livewire.expert');
    }
}
