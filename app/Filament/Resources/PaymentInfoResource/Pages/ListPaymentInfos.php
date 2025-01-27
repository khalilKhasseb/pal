<?php

namespace App\Filament\Resources\PaymentInfoResource\Pages;

use App\Filament\Resources\PaymentInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPaymentInfos extends ListRecords
{
    protected static string $resource = PaymentInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
