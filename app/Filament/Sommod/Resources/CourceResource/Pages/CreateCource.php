<?php

namespace App\Filament\Sommod\Resources\CourceResource\Pages;

use App\Filament\Sommod\Resources\CourceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\LocaleSwitcher;
use App\Traits\HasMultiablePanels;
class CreateCource extends CreateRecord
{
    use CreateRecord\Concerns\Translatable , HasMultiablePanels {
        HasMultiablePanels::handleRecordCreation insteadof CreateRecord\Concerns\Translatable;
    }

    protected static string $resource = CourceResource::class;

    public  function getHeaderActions(): array {
        return [
            LocaleSwitcher::make()
        ];
    }
}
