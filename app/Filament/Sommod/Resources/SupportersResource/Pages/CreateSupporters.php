<?php

namespace App\Filament\Sommod\Resources\SupportersResource\Pages;

use App\Filament\Sommod\Resources\SupportersResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;
use App\Traits\HasMultiablePanels;
class CreateSupporters extends CreateRecord
{
    use CreateRecord\Concerns\Translatable, HasMultiablePanels {
        HasMultiablePanels::handleRecordCreation insteadof CreateRecord\Concerns\Translatable;
    }

    protected static string $resource = SupportersResource::class;


  protected  function getHeaderActions():  array {
        return [
          LocaleSwitcher::make()
        ];
  }
}
