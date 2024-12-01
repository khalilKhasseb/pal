<?php

namespace App\Filament\Resources\GallaryResource\Pages;

use App\Filament\Resources\GallaryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGallary extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    use \App\Traits\InteractWithRecordOverwrite;
    protected static string $resource = GallaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
