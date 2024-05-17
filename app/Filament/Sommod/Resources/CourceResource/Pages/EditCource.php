<?php

namespace App\Filament\Sommod\Resources\CourceResource\Pages;

use App\Filament\Sommod\Resources\CourceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\LocaleSwitcher;

class EditCource extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = CourceResource::class;

    protected  function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            LocaleSwitcher::make()
        ];
    }
}
