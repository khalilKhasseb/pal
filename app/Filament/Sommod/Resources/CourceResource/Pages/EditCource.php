<?php

namespace App\Filament\Sommod\Resources\CourceResource\Pages;

use App\Filament\Sommod\Resources\CourceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\LocaleSwitcher;

class EditCource extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    use \App\Traits\EditResourceHasPanels;
    protected static string $resource = CourceResource::class;

    protected  function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successRedirectUrl(static::$resource::getUrl()),
            LocaleSwitcher::make()
        ];
    }


    protected function successRedirectUrl(): string|null {
        return "https://google.com";
    }
}
