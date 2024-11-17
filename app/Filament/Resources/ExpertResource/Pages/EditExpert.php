<?php

namespace App\Filament\Resources\ExpertResource\Pages;

use App\Filament\Resources\ExpertResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\LocaleSwitcher;

class EditExpert extends EditRecord
{
    use EditRecord\Concerns\Translatable,
        \App\Traits\EditResourceHasPanels;

    protected static string $resource = ExpertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            LocaleSwitcher::make()
            
        ];
    }
}
