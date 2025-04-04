<?php

namespace App\Livewire;

use App\Models\Cource;
use Illuminate\Support\Collection;
use Livewire\Component;

class CourcePage extends Component
{
    public Collection $courcess ;

    public string $pageTitle ;
    public function mount() {
        $this->courcess = Cource::all()->map(function($cource){
            $cource->image = $cource->getFirstMediaUrl('cources');
            $cource->form_register = is_null($cource->form) ? null :  $cource->form->responder_uri;
            unset($cource->form);

            return $cource;
        }) ;

        
        $this->pageTitle = __('Cources');

    }
    public function render()
    {

        return view('livewire.cource-page');
    }
}
