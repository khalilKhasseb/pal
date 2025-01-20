<?php

namespace App\Livewire;

use App\Models\Panel;
use App\Models\Post;
use Livewire\Component;
use App\Settings\SiteSetting;
use App\Settings\ContentSettings;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use App\Models\Scopes\PanelScope;
use App\Models\Scopes\ContentProviderScope;

#[Layout('layouts.theme-layout')]
class Home extends Component
{
    public Collection $siteSetting;
    public Collection $contentSettings;

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


        $recentQuery = config('zeus-sky.models.Post')::query();

        
        if (session()->has('council_load')) {
            // From over here i remove the scope that prevent mixing soumd news with council news
            // in concil home page we show all news this for front end only
            // there is issue with session managemt for the firts time it not work

            /**
             * The issue is that the session is not set in the first time & is traying to get the session value
             * TO solve this issue we had to set the content provider in the Smoud middleware at each time 
             **/

            $recentQuery->withoutGlobalScope(\App\Models\Scopes\ContentProviderScope::class);
        
        }

            

            
          $this->recent  =  $recentQuery->posts()
            ->published()
            ->whereDate('published_at', '<=', now())
            ->with(['tags', 'author', 'media'])
            ->limit(config('zeus-sky.recentPostsLimit'))
            ->orderBy('published_at', 'desc')
            ->get();


        $this->sponsers = config('zeus-sky.models.Post')::query()
            ->partner()
            ->published('partner')
            ->with(['tags', 'author', 'media'])
            ->limit(config('zeus-sky.recentPostsLimit'))
            ->orderBy('published_at', 'desc')
            ->get();
           
        $this->gallaries = \App\Models\Gallary::withoutGlobalScope(ContentProviderScope::class)->showInSlider()->get();

        $this->contentSettings = app(ContentSettings::class)->toCollection();
    }
    public function render()
    {
        return view('livewire.home');
    }
}
