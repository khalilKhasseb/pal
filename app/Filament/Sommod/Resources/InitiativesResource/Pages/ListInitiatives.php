<?php

namespace App\Filament\Sommod\Resources\InitiativesResource\Pages;

use App\Filament\Sommod\Resources\InitiativesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInitiatives extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = InitiativesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
