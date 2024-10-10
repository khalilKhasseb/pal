<?php

namespace App\Filament\Sommod\Resources\EnviromentalDayResource\Pages;

use App\Filament\Sommod\Resources\EnviromentalDayResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEnviromentalDays extends ManageRecords
{
    use ManageRecords\Concerns\Translatable;

    protected static string $resource = EnviromentalDayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make()
        ];
    }
}
