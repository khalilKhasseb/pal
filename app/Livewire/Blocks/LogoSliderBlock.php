<?php

namespace App\Livewire\Blocks;
use  Livewire\Component;

class LogoSliderBlock extends Component
{
    public array $logos = [];
    public ?string $title = null;
    public int $slidesPerView = 4;
    public bool $autoPlay = true;
    public int $autoPlaySpeed = 3000;
    public bool $showNavigation = true;
    public bool $showPagination = false;
    
    public function mount($logos = [], $title = null, $slidesPerView = 4, $autoPlay = true, $autoPlaySpeed = 3000, $showNavigation = true, $showPagination = false)
    {
        $this->logos = $logos;
        $this->title = $title;
        $this->slidesPerView = (int) $slidesPerView;
        $this->autoPlay = $autoPlay;
        $this->autoPlaySpeed = (int) $autoPlaySpeed;
        $this->showNavigation = $showNavigation;
        $this->showPagination = $showPagination;
    }
    
    public function render()
    {
        return view('livewire.blocks.logo-slider-block');
    }
}
