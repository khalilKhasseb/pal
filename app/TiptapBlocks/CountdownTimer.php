<?php

namespace App\TiptapBlocks;

use FilamentTiptapEditor\TiptapBlock;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components as CMP;

class CountdownTimer extends TiptapBlock
{
    public string $preview = 'tiptap-blocks.previews.countdown-timer';

    public string $rendered = 'tiptap-blocks.rendered.countdown-timer';
    public ?string $icon = 'heroicon-o-film';



    public function getFormSchema(): array
    {
        return [
            // this filed is uppon condition if want to show or not basesd if want to calcuate two periods of time.

            TextInput::make('title')
            ->label(__('Title'))
            ,
            
            CMP\Toggle::make('count_from_current_date')
                ->label('Count from current date')
                ->onColor('success')
                ->offColor('danger')
                ->default(true)
                ->live(),

            CMP\DatePicker::make('start_date')
                ->live()
                ->hidden(fn($get) => $get('count_from_current_date'))
                ->label('Start Date'),

            CMP\DatePicker::make('end_date')
                ->label('End Date'),

        ];
    }
}