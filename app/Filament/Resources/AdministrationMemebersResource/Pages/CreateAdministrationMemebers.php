<?php

namespace App\Filament\Resources\AdministrationMemebersResource\Pages;

use App\Filament\Resources\AdministrationMemebersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\LocaleSwitcher;
use App\Traits\HasMultiablePanels;

class CreateAdministrationMemebers extends CreateRecord
{
    use CreateRecord\Concerns\Translatable, HasMultiablePanels {
        HasMultiablePanels::handleRecordCreation insteadof CreateRecord\Concerns\Translatable;
    }

    protected static string $resource = AdministrationMemebersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
