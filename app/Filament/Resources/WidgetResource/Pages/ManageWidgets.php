<?php

namespace App\Filament\Resources\WidgetResource\Pages;

use App\Filament\Resources\WidgetResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWidgets extends ManageRecords
{
    use ManageRecords\Concerns\Translatable;

    protected static string $resource = WidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
               ,
            Actions\LocaleSwitcher::make(),
        ];
    }
}
