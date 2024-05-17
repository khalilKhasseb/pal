<?php

namespace App\Filament\Resources\HallResource\Pages;

use App\Filament\Resources\HallResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\LocaleSwitcher;

class EditHall extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = HallResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            LocaleSwitcher::make()
        ];
    }
}
