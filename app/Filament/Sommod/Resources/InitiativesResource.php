<?php

namespace App\Filament\Sommod\Resources;

use App\Filament\Sommod\Resources\InitiativesResource\Pages;
use App\Filament\Sommod\Resources\InitiativesResource\RelationManagers;
use App\Models\Initiative;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;


use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Tables\Columns\TextColumn;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Resources\Concerns\Translatable;
use App\Filament\Sommod\Resources\InitiativesResource\RelationManagers\SupportersRelationManager;
use Dompdf\FrameDecorator\Text;

class InitiativesResource extends Resource
{
    use Translatable;
    protected static ?string $model = Initiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('Title'))
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state, $context) {
                        if ($context === 'edit') {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    }),
                    TextInput::make('slug')
                    ->label('Slug'),

                  TextInput::make('order')
                    ->label(__('Order'))
                    ->numeric(),
                    //->required()
                
                Select::make('panels')
                    ->label(__('Panel'))
                    ->multiple()
                    ->default(
                        array_slice(\App\Models\Panel::first()->pluck('id', 'panel_name')->toArray(), 0, 1, true)
                    )
                    ->relationship('panels', titleAttribute: 'panel_name')
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                ->label(__('Title')),
                Tables\Columns\TextColumn::make('panels.panel_name')
                ->label(__("Panel")),
            ])
            ->filters([
                //
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

    public static function getNavigationLabel() : string {
        return __("Initiatives");
    }

    public static function getModelLabel():string {
        return __("Initiative");
    }

    public static function getPluralLabel() :string {
        return __("Initiatives");
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getRelations(): array
    {
        return [
            SupportersRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInitiatives::route('/'),
            'create' => Pages\CreateInitiatives::route('/create'),
            'edit' => Pages\EditInitiatives::route('/{record}/edit'),
        ];
    }
}
