<?php

namespace App\Filament\Resources\PartnersResource\Pages;

use App\Filament\Resources\PartnersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Traits\HasMultiablePanels;
use Filament\Actions\LocaleSwitcher;

class CreatePartners extends CreateRecord
{
    use CreateRecord\Concerns\Translatable, HasMultiablePanels {
        HasMultiablePanels::handleRecordCreation insteadof CreateRecord\Concerns\Translatable;
    }

    protected static string $resource = PartnersResource::class;
    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
