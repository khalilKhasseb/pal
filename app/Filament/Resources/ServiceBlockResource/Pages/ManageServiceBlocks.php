<?php

namespace App\Filament\Resources\ServiceBlockResource\Pages;

use App\Filament\Resources\ServiceBlockResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageServiceBlocks extends ManageRecords
{
    // use ManageRecords\Concerns\Translatable;
    protected static string $resource = ServiceBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            // Actions\LocaleSwitcher::make()
        ];
    }
}
