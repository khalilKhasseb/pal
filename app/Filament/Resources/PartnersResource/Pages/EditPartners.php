<?php

namespace App\Filament\Resources\PartnersResource\Pages;

use App\Filament\Resources\PartnersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\LocaleSwitcher;

class EditPartners extends EditRecord
{
    use EditRecord\Concerns\Translatable,
        \App\Traits\EditResourceHasPanels;
    use \App\Traits\InteractWithRecordOverwrite;
    protected static string $resource = PartnersResource::class;

    protected function getHeaderActions(): array
    {
        
        return [
            Actions\DeleteAction::make(),
            LocaleSwitcher::make(),
        ];
    }
}
