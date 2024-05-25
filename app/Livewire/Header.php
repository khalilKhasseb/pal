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

    public bool $sommod = false;

    public function mount() {

        # init settings
        #$this->settings = app(HeaderSetting::class);

        #$this->topHeaderItems = $this->settings->top_header_items;
        #$this->topHeaderEnabled = $this->settings->top_header_enabled;
        // we want to mount menus according to reqest uri
        // whenever reqeust uri starts with sommod-home or has a query paramenter p=sommod load sommd menue
        // Set up handel to take sommod paramenters
        #if site is in home
        $handel = 'main-header-menu';
        if(request()->routeIs('front.sommod.home')) {
            $this->sommod = true;
            $handel = 'main-sommod-header-menu';

        }



        if (isset(request()->query()['p']) && request()->query()['p'] == 'sommod') {
            $this->sommod = true;
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
