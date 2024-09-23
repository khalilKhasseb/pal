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

        $handel = json_decode(Storage::get('content_provider.json'))->provider === 'somoud'
            ? 'main-sommod-header-menu'
            : 'main-header-menu';

        $this->menu = \LaraZeus\Sky\SkyPlugin::get()->getModel('Navigation')::fromHandle($handel);
    }
    public function render()
    {
        $header_settings = app(HeaderSetting::class);
        $settings = app(SiteSetting::class);
        $_logo = $settings->site_logo;
        if (session()->has('somoud_load')) {
            $_logo = $settings->sommod_logo;
        }
        return view('livewire.header', compact('header_settings', '_logo'));
    }
}
