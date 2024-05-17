<?php

namespace App\Filament\Sommod\Resources\SupportersResource\Pages;

use App\Filament\Sommod\Resources\SupportersResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;

class CreateSupporters extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = SupportersResource::class;


  protected  function getHeaderActions():  array {
        return [
          LocaleSwitcher::make()
        ];
  }
}
