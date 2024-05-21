<?php

namespace App\Livewire;

use Livewire\Component;
use App\Settings\HeaderSetting;
use App\Settings\SiteSetting;

class Header extends Component
{
    public $menu;
    public $logo;

    // public HeaderSetting $settings;

    public array $topHeaderItems;

    public bool $topHeaderEnabled;
    
    public function mount() {

        # init settings
        #$this->settings = app(HeaderSetting::class);

        #$this->topHeaderItems = $this->settings->top_header_items;
        #$this->topHeaderEnabled = $this->settings->top_header_enabled;
        // we want to mount menus according to reqest uri 
        // whenever reqeust uri starts with sommod-home or has a query paramenter p=sommod load sommd menue
        // Set up handel to take sommod paramenters 
        #if site is in home 
        $handel = request()->routeIs('front.sommod.home') ? 'main-sommod-header-menu' : 'main-header-menu';

        if (isset(request()->query()['p']) && request()->query()['p'] == 'sommod') {

            $handel = 'main-sommod-header-menu';
        }

        $this->menu = \LaraZeus\Sky\SkyPlugin::get()->getModel('Navigation')::fromHandle($handel);
    }
    public function render()
    {  
         $settings = app(HeaderSetting::class);
         $_logo = app(SiteSetting::class)->site_logo;
        
        return view('livewire.header', compact('settings' , '_logo'));
     
    }
}
