<?php

namespace App\Filament\Sommod\Resources;

use App\Filament\Sommod\Resources\EnviromentalDayResource\Pages;
use App\Filament\Sommod\Resources\EnviromentalDayResource\RelationManagers;
use App\Models\EnviromentalDay;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;

class EnviromentalDayResource extends Resource
{
    use Translatable;

    protected static ?string $model = EnviromentalDay::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPluralLabel() :string {
        return __('Enviromental Days');
    }
    public static function getLabel(): ?string {
        return __('Enviromental Day');
    }

    public static function getNavigationBadge() : string  {
        return static::$model::count();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('Title'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('month')
                    ->label(__('Month'))
                    ->options(function () {
                        $months = [
                            'January' => __('January'),
                            'February' => __('February'),
                            'March' => __('March'),
                            'April' => __('April'),
                            'May' => __('May'),
                            'June' => __('June'),
                            'July' => __('July'),
                            'August' => __('August'),
                            'September' => __('September'),
                            'October' => __('October'),
                            'November' => __('November'),
                            'December' => __('December'),
                        ];


                        return $months;

                    }),
                Forms\Components\TextInput::make('day')
                    ->label(__('Day'))
                    ->required()
                    ->numeric(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                ->label(__('Title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('month')
                ->label(__('Month'))
                    ->formatStateUsing(function (Tables\Columns\TextColumn $column, $state) {
                        return __($state);
                })
                    ->searchable(),
                Tables\Columns\TextColumn::make('day')
                ->label(__('Day'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEnviromentalDays::route('/'),
        ];
    }
}
