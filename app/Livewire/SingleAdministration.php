<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
class SingleAdministration extends Component
{
    public $member; 

    public function mount($slug) 
    {
        $this->member = Post::where('slug', $slug)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.single-administration')
        ->layout('layouts.theme-layout');
    }
}
