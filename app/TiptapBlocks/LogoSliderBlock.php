<?php

namespace App\TiptapBlocks;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use FilamentTiptapEditor\TiptapBlock;

class LogoSliderBlock extends TiptapBlock
{
    public string $preview = 'tiptap-blocks.previews.logo-slider';
    public string $rendered = 'tiptap-blocks.rendered.logo-slider';
    public ?string $icon = 'heroicon-o-photo';
    public string $width = '2xl';
    
    public function getFormSchema(): array
    {
        return [
            FileUpload::make('logos')
                ->label('Logo Images')
                ->multiple()
                ->image()
                ->imageResizeMode('cover')
                ->maxSize(1024)
                ->required(),
            TextInput::make('title')
                ->label('Slider Title')
                ->placeholder('Our Trusted Partners'),
            Select::make('slides_per_view')
                ->label('Logos Per View')
                ->options([
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ])
                ->default('4'),
            Toggle::make('auto_play')
                ->label('Auto Play')
                ->default(true),
            TextInput::make('auto_play_speed')
                ->label('Auto Play Speed (ms)')
                ->type('number')
                ->default(3000)
                ->visible(fn (callable $get) => $get('auto_play')),
            Toggle::make('show_navigation')
                ->label('Show Navigation Arrows')
                ->default(true),
            Toggle::make('show_pagination')
                ->label('Show Pagination Dots')
                ->default(false),
        ];
    }
}