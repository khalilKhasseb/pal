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

    public function mount() {



        $handel = json_decode(Storage::get('content_provider.json'))->provider === 'sommod'
        ? 'main-sommod-header-menu'
        :'main-header-menu';

        $this->menu = \LaraZeus\Sky\SkyPlugin::get()->getModel('Navigation')::fromHandle($handel);
    }
    public function render()
    {
         $settings = app(HeaderSetting::class);
         $_logo = app(SiteSetting::class)->site_logo;

        return view('livewire.header', compact('settings' , '_logo'));

    }
}
