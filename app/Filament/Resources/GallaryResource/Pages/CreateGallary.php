<?php

namespace App\Filament\Resources\GallaryResource\Pages;

use App\Filament\Resources\GallaryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Traits\HasMultiablePanels;

class CreateGallary extends CreateRecord
{
    use CreateRecord\Concerns\Translatable, HasMultiablePanels {
        HasMultiablePanels::handleRecordCreation insteadof CreateRecord\Concerns\Translatable;
    }
    protected static string $resource = GallaryResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
