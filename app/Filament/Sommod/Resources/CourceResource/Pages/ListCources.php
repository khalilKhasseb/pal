<?php

namespace App\Filament\Sommod\Resources\CourceResource\Pages;

use App\Filament\Sommod\Resources\CourceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCources extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = CourceResource::class;

    protected  function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make()
        ];
    }
}
