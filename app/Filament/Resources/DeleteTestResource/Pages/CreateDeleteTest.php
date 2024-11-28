<?php

namespace App\Filament\Resources\DeleteTestResource\Pages;

use App\Filament\Resources\DeleteTestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeleteTest extends CreateRecord
{
    protected static string $resource = DeleteTestResource::class;
}
