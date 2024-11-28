<?php

namespace App\Filament\Resources\ExpertResource\Pages;

use App\Filament\Resources\ExpertResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Expert;

class EditExpert extends EditRecord
{
    protected static string $resource = ExpertResource::class;

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
            Actions\Action::make('delete')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->action(function (Expert $record) {
                    // Delete the record
                    // $record->delete();

                    // Notify the user
                   \Filament\Notifications\Notification::make()
                        ->success()
                        ->title('Record deleted successfully')
                        ->send();

                    // Manually trigger a redirect
                     redirect()->route('filament.admin.resources.experts.index');
                }),
            //->successRedirectUrl($this->getRedirectUrl()),
        ];
    }
}
