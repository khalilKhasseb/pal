<?php

namespace App\Filament\Resources\EventsResource\Pages;

use App\Filament\Resources\EventsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\LocaleSwitcher;

class EditEvents extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = EventsResource::class;

        protected function getHeaderActions(): array
        {
            return [
                //Actions\DeleteAction::make(),
                LocaleSwitcher::make(),
            ];
        }
}
