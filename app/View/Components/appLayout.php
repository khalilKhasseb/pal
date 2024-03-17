<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Settings\SiteSetting;

class appLayout extends Component
{
    /**
     * Create a new component instance.
     */

    public $attributes = [
        'settings' => app(SiteSetting::class),

    ];
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('theme.layout.app-layout', [
            'test' => "Test Vakyue"

        ]);
    }
}
