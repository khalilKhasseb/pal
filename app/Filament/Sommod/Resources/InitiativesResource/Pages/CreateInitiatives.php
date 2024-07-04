<?php

namespace App\Filament\Sommod\Resources\InitiativesResource\Pages;

use App\Filament\Sommod\Resources\InitiativesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Traits\HasMultiablePanels;
class CreateInitiatives extends CreateRecord
{
    use CreateRecord\Concerns\Translatable, HasMultiablePanels {
        HasMultiablePanels::handleRecordCreation insteadof CreateRecord\Concerns\Translatable;
    }

    protected static string $resource = InitiativesResource::class;
    public function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make()
        ];
    }
}
