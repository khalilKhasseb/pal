<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\LocaleSwitcher;

class EditActivity extends EditRecord
{
    use EditRecord\Concerns\Translatable,
        \App\Traits\EditResourceHasPanels;
    use \App\Traits\InteractWithRecordOverwrite;

    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            LocaleSwitcher::make(),
        ];
    }
}
