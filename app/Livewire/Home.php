<?php

namespace App\Livewire;

use App\Models\Panel;
use App\Models\Post;
use Livewire\Component;
use App\Settings\SiteSetting;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use App\Models\Scopes\PanelScope;

#[Layout('layouts.theme-layout')]
class Home extends Component
{

    public Collection $siteSetting;

    public Collection $gallaries;

    public Collection $serviceBlocks;

    public Collection $recent;
    public Collection $sponsers;

    public bool $sommod = false;
    public function mount()
    {
        $this->loadContent();
    }

    protected function loadContent()
    {
        //Posts
        //Navigation items
        // $load = str_contains(str_replace('/', '', request()->getRequestUri()), 'home-sommod');

        // $this->sommod = $load;
        $this->recent = config('zeus-sky.models.Post')::query()
            ->withoutGlobalScopes([PanelScope::class])
            //->sommod($load)
            ->posts()
            ->published()
            ->whereDate('published_at', '<=', now())
            ->with(['tags', 'author', 'media'])
            ->limit(config('zeus-sky.recentPostsLimit'))
            ->orderBy('published_at', 'desc')
            ->get();

        $this->sponsers = config('zeus-sky.models.Post')::query()
            // ->sommod(false)
            ->partner()
            ->published('partner')
            ->with(['tags', 'author', 'media'])
            ->limit(config('zeus-sky.recentPostsLimit'))
            ->orderBy('published_at', 'desc')
            ->get();

        $this->gallaries = \App\Models\Gallary::showInSlider()->get();
        $this->serviceBlocks = \App\Models\ServiceBlock::all();
    }
    public function render()
    {

        // $recent = config('zeus-sky.models.Post')::query()
        //     ->withoutGlobalScopes([PanelScope::class])
        //     ->sommod()
        //     ->posts()
        //     ->published()
        //     ->whereDate('published_at', '<=', now())
        //     ->with(['tags', 'author', 'media'])
        //     ->limit(config('zeus-sky.recentPostsLimit'))
        //     ->orderBy('published_at', 'desc')
        //     ->get();

        // $sponsers = config('zeus-sky.models.Post')::query()
        //     ->partner()
        //     ->published('partner')
        //     ->with(['tags', 'author', 'media'])
        //     ->limit(config('zeus-sky.recentPostsLimit'))
        //     ->orderBy('published_at', 'desc')
        //     ->get();



        return view('livewire.home')
            //->with('recentPosts', $recent)
            // ->with('sponsers', $sponsers)

        ;
    }
}
