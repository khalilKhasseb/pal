<?php

namespace App\Filament\Sommod\Resources\SupportersResource\Pages;

use App\Filament\Sommod\Resources\SupportersResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;

class EditSupporters extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    use \App\Traits\EditResourceHasPanels;
    use \App\Traits\InteractWithRecordOverwrite;
    protected static string $resource = SupportersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            LocaleSwitcher::make()
        ];
    }
}
