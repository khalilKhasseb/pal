<?php

namespace App\Filament\Resources\AdministrationMemebersResource\Pages;

use App\Filament\Resources\AdministrationMemebersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\LocaleSwitcher;

class EditAdministrationMemebers extends EditRecord
{
    use EditRecord\Concerns\Translatable,   
        \App\Traits\EditResourceHasPanels;

    protected static string $resource = AdministrationMemebersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\DeleteAction::make(),
            LocaleSwitcher::make(),
        ];
    }
}
