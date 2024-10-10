<?php

namespace App\Livewire\EnviromentalDays;

// use App\Models\EnviromentalDay;
// use Filament\Forms\Concerns\InteractsWithForms;
// use Filament\Forms\Contracts\HasForms;
// use Filament\Tables;
// use Filament\Tables\Concerns\InteractsWithTable;
// use Filament\Tables\Contracts\HasTable;
// use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
// use Illuminate\Database\Eloquent\Builder;

class ListDays extends Component 
{
    // use InteractsWithForms;
    // use InteractsWithTable;
    public $envDays;
    public function mount() {
        $this->envDays = \App\Models\EnviromentalDay::all();
    }


    public function render(): View
    {
        return view('livewire.enviromental-days.list-days');
    }
}
