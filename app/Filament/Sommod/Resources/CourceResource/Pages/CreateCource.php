<?php

namespace App\Filament\Sommod\Resources\CourceResource\Pages;

use App\Filament\Sommod\Resources\CourceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\LocaleSwitcher;

class CreateCource extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = CourceResource::class;

    public  function getHeaderActions(): array {
        return [
            LocaleSwitcher::make()
        ];
    }
}
