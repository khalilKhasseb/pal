<?php

namespace App\Filament\Resources\EventsResource\Pages;

use App\Filament\Resources\EventsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\LocaleSwitcher;
use App\Traits\HasMultiablePanels;
class CreateEvents extends CreateRecord
{
    use CreateRecord\Concerns\Translatable, HasMultiablePanels {
        HasMultiablePanels::handleRecordCreation insteadof CreateRecord\Concerns\Translatable;
    }
    protected static string $resource = EventsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
