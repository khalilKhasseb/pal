<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\LocaleSwitcher;
class EditService extends EditRecord
{
    use EditRecord\Concerns\Translatable,
        \App\Traits\EditResourceHasPanels;
    
    

    protected static string $resource = ServiceResource::class;

    
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            LocaleSwitcher::make(),

        ];
    }
}
