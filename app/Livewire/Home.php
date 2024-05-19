<?php

namespace App\Livewire;

use App\Models\Panel;
use App\Models\Post;
use Livewire\Component;
use App\Settings\SiteSetting;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
#[Layout('layouts.app-layout')]
class Home extends Component
{

    public Collection $siteSetting;

    public Collection $gallaries;

    public Collection $serviceBlocks;
    public function mount()
    {
        //dd(app(SiteSetting::class));
        //$this->siteSetting = ->toCollection();
        $this->gallaries = \App\Models\Gallary::showInSlider()->get();
        $this->serviceBlocks = \App\Models\ServiceBlock::all();
        


    }
    public function render()

    {
        $recent = config('zeus-sky.models.Post')::query()
            ->posts()
            ->published()
            ->whereDate('published_at', '<=', now())
            ->with(['tags', 'author', 'media'])
            ->limit(config('zeus-sky.recentPostsLimit'))
            ->orderBy('published_at', 'desc')
            ->get();

        $sponsers = config('zeus-sky.models.Post')::query()
            ->partner()
            ->published('partner')
            ->with(['tags', 'author', 'media'])
            ->limit(config('zeus-sky.recentPostsLimit'))
            ->orderBy('published_at', 'desc')
            ->get();
        

        
        return view('livewire.home')
         ->with('recentPosts' , $recent)
         ->with('sponsers' , $sponsers)
    
        ;
    }
}
