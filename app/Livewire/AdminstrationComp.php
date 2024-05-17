<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Collection;
class AdminstrationComp extends Component
{
    public Collection $members;

    public function mount() {
        $this->members = Post::administration()->get();
    }
    public function render()
    {
        return view('livewire.adminstration-comp')
        ->layout('theme.layout.app-layout');
    }
}
