<?php

namespace App\Livewire;

use Livewire\Component;
use App\Settings\HeaderSetting;
use App\Settings\SiteSetting;
use Illuminate\Support\Facades\Storage;

class Header extends Component
{
    public $menu;
    public $logo;

    // public HeaderSetting $settings;

    public array $topHeaderItems;

    public bool $topHeaderEnabled;

    public bool $sommod = false;

    public function mount()
    {

        // $handel = json_decode(Storage::get('content_provider.json'))->provider === 'somoud'
        //     ? 'main-sommod-header-menu'
        //     : 'main-header-menu';

        $this->menu = \LaraZeus\Sky\SkyPlugin::get()->getModel('Navigation')::fromHandle('main-header-menu');
    }
    public function render()
    {
        
        $header_settings = app(HeaderSetting::class);
        
        $settings = app(SiteSetting::class);
        
        $_logo = filled($settings->site_logo) ? $settings->site_logo : config('theme.console_logo');
        if (session()->has('somoud_load')) {
            $_logo = $settings->sommod_logo ? $settings->sommod_logo : config('theme.samoud_logo');
        }
        return view('livewire.header', compact('header_settings', '_logo'));
    }
}
