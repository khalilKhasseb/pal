<?php

namespace App\Filament\Resources;

use App\Models\PaymentInfo;
use Filament\Resources\Resource;
// use Filament\Resources\Pages\ListRecords;
// use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Tables;
use App\Filament\Resources\PaymentInfoResource\Pages;

class PaymentInfoResource extends Resource
{
    protected static ?string $model = PaymentInfo::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make(__('Payment Information'))
                    ->schema([
                        Components\TextEntry::make('reference')
                            ->label(__('Reference')),
                        Components\TextEntry::make('full_name')
                            ->label(__('Full Name')),
                        Components\TextEntry::make('email')
                            ->label(__('Email')),
                        Components\TextEntry::make('mobile')
                            ->label(__('Mobile')),
                        Components\TextEntry::make('address')
                            ->label(__('Address')),
                    ])
                    ->columns(2),

                Components\Section::make(__('Transaction Details'))
                    ->schema([
                        Components\TextEntry::make('purpose')
                            ->label(__('Purpose')),
                        Components\TextEntry::make('classification')
                            ->label(__('Classification')),
                        Components\TextEntry::make('amount')
                            ->label(__('Amount'))
                            ->money(fn($record) => $record->currency),
                        Components\TextEntry::make('currency')
                            ->label(__('Currency')),
                        Components\TextEntry::make('contact_before_payment')
                            ->label(__('Contact Before Payment'))
                            ->badge()
                            ->color(fn(bool $state): string => $state ? 'success' : 'danger')
                            ->formatStateUsing(fn(bool $state): string => $state ? __('Yes') : __('No')),
                    ])
                    ->columns(2),

                Components\Section::make(__('System Information'))
                    ->schema([
                        Components\TextEntry::make('status')
                            ->label(__('Status'))
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'pending' => 'warning',
                                'success' => 'success',
                                'failed' => 'danger',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn(string $state): string => __(ucfirst($state))),
                            
                        Components\KeyValueEntry::make('api_response_for_display')
                            ->label(__('API Response'))
                            ->columnSpanFull()
                            ->hidden(fn($state) => empty($state)), // Fixes the array error
                        Components\TextEntry::make('created_at')
                            ->label(__('Created At'))
                            ->dateTime(),
                        Components\TextEntry::make('updated_at')
                            ->label(__('Updated At'))
                            ->dateTime(),
                    ])
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')
                    ->label(__('Reference'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label(__('Full Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label(__('Amount'))
                    ->money(fn($record) => $record->currency)
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => __(ucfirst($state))),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }


    public static function getNavigationGroup(): ?string
    {
        return __('Payments');
    }
    public static function getModelLabel(): string
    {
        return __('Payment');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Payments');
    }

    public static function getNavigationLabel(): string
    {
        return __('Payments');
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentInfos::route('/'),
            // 'view' => Pages\ViewPaymentInfo::route('/{record}'), // Ensure this exists

            // 'view' => ViewRecord::route('/{record}'),
        ];
    }
}
