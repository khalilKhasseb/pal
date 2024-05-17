<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\LocaleSwitcher;
use App\Traits\HasMultiablePanels;

class CreateService extends CreateRecord
{
    use CreateRecord\Concerns\Translatable, HasMultiablePanels {
        HasMultiablePanels::handleRecordCreation insteadof CreateRecord\Concerns\Translatable;
    }
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
