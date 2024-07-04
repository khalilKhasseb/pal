<?php

namespace App\Livewire;

use App\Models\Gallary;
use Livewire\Component;

class GallaryPage extends Component
{
    public function render()
    {    $galleris = Gallary::all();
        return view('livewire.gallary-page')
        ->with('galleris' ,$galleris);
    }
}
