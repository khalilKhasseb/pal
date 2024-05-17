<?php

namespace App\Filament\Sommod\Resources\InitiativesResource\Pages;

use App\Filament\Sommod\Resources\InitiativesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInitiatives extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = InitiativesResource::class;
    public function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make()
        ];
    }
}
