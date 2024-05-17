<?php

namespace App\Filament\Sommod\Resources\SupportersResource\Pages;

use App\Filament\Sommod\Resources\SupportersResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use ListRecords\Concerns\Translatable;

class ListSupporters extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = SupportersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            LocaleSwitcher::make(),
        ];
    }
}
