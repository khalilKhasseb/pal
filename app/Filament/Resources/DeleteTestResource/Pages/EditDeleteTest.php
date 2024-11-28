<?php

namespace App\Filament\Resources\DeleteTestResource\Pages;

use App\Filament\Resources\DeleteTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeleteTest extends EditRecord
{
    protected static string $resource = DeleteTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
