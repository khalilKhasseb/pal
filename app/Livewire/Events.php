<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use App\Models\Post;
class Events extends Component
{
    public Collection $events ;

    public string $searchQuery = "dwdwdw";
    protected $queryString = ['search'];
    public function mount() {
        $this->events = Post::event()->get();
    }

    public function search() {
        $this->events = Post::event()
        ->where('title', 'like', '%' . $this->searchQuery . '%')
        ->orWhere('description' , 'like', '%' . $this->searchQuery . '%')
        ->get();
    }
    public function render()
    {
        return view('livewire.events')
        ->layout('theme.layout.app-layout');
    }
}
