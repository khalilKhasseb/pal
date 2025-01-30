<?php

namespace App\Filament\Sommod\Resources;

use App\Filament\Sommod\Resources\CourceResource\Pages;
use App\Filament\Sommod\Resources\CourceResource\RelationManagers;
use App\Models\Cource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Actions\LocaleSwitcher;
use Filament\Tables\Filters\TernaryFilter;
class CourceResource extends Resource
{
    use Translatable;

    protected static ?string $model = Cource::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Forms\Components\Fieldset::make(__('Activate Or Deactivate'))
                    ->schema([
                        Forms\Components\Toggle::make('active')
                            ->label(function($state) {
                                if(!$state) {
                                    return __('Activate');
                                }
                                return __('Deactivate');
                            })
                        
                    ])->columns(2),

                Forms\Components\Section::make(__('Cource info'))
                    ->schema([
                        Forms\Components\Select::make('google_form_id')
                            ->label(__('Form'))
                            ->relationship(name: 'google_form', titleAttribute: 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('title')
                            ->label(__('Title'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('location')
                            ->label(__('Location'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('trainer')
                            ->label(__('Trainer'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('target_audince')
                            ->label(__('Target audince'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('partners')
                            ->label(__('Partners'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('hours')
                            ->label(__('Hours'))
                            ->required()
                            ->numeric(),
                        Forms\Components\DateTimePicker::make('start_date')
                            ->label(__('Start date'))
                            ->required(),
                        Forms\Components\DateTimePicker::make('end_date')
                            ->label(__('End date')),
                        Forms\Components\TextInput::make('fees')
                            ->label(__("Fees"))
                            ->maxLength(255),
                        Forms\Components\Select::make('panels')
                            ->label(__('Panel'))
                            ->multiple()
                            ->relationship('panels', titleAttribute: 'panel_name')
                            ->default(
                                array_slice(\App\Models\Panel::findByName(filament()->getCurrentPanel()->getId())->pluck('id', 'panel_name')->toArray(), 0, 1, true)
                            )
                            ->preload()

                    ])->columns(3),
                

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label(__('Summary'))
                            ->required()
                            ->maxLength(65535),

                        Forms\Components\RichEditor::make('objective')
                            ->label(__("Objective"))
                            ->required()
                            ->maxLength(65535),


                    ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('panels.panel_name')
                    ->label(__('Panel')),
                Tables\Columns\TextColumn::make('form.name')
                    ->label(__('Form'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->label(__("Location"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('trainer')
                    ->label(__("Trainer"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('target_audince')
                    ->label(__("Target audince"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('partners')
                    ->label(__("Partners"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label(__("Start date"))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label(__("End date"))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fees')
                    ->label(__("Fees"))
                    ->searchable(),
                Tables\Columns\IconColumn::make('scholership')
                    ->label(__("Scholership"))
                    ->boolean(),
                Tables\Columns\TextColumn::make('hours')
                    ->label(__('Hours'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__("created at"))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__("zeus-sky::filament-navigation.attributes.updated_at"))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                TernaryFilter::make('scholership'),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getNavigationLabel(): string
    {
        return __('Cources');
    }

    public static function getModelLabel(): string
    {
        return __('Cource');
    }
    public static function getPluralLabel(): string
    {
        return __("Cources");
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getHeaderAction(): array
    {
        return [
            LocaleSwitcher::make()
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCources::route('/'),
            'create' => Pages\CreateCource::route('/create'),
            'edit' => Pages\EditCource::route('/{record}/edit'),
        ];
    }
}
