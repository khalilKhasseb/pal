<?php

namespace App\Filament\Sommod\Resources\InitiativesResource\Pages;

use App\Filament\Sommod\Resources\InitiativesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInitiatives extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = InitiativesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
