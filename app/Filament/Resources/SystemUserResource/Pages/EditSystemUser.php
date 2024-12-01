<?php

namespace App\Filament\Resources\SystemUserResource\Pages;

use App\Filament\Resources\SystemUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSystemUser extends EditRecord
{
    use \App\Traits\InteractWithRecordOverwrite;
    protected static string $resource = SystemUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
