<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeSectionResource\Pages;
use App\Filament\Resources\HomeSectionResource\RelationManagers;
use App\Models\HomeSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use App\Classes\WidgetsForms;

class HomeSectionResource extends Resource
{
    use \App\Traits\ConcielAccess;
    protected static ?string $model = HomeSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function canAccess(): bool
    {
        return false;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Select::make('component')
                    ->label(__('Layout'))
                    ->options(WidgetsForms::load_components())
                    ->live()
                    ->afterStateUpdated(function (Select $component, Set $set, $state) {
                        $set('type', str_replace('component-', '', $state));
                        return $component
                            ->getContainer()
                            ->getComponent('componentsBuilder')
                            ->getChildComponentContainer()
                            ->fill();
                    }),
                TextInput::make('type')
                    ->label(__('Type'))
                    ->disabled(),
                Select::make('location')
                    ->label(__('Location'))
                    ->options([
                        'footer' => __('Footer'),
                        'homepage' => __('Homepage'),
                        'bottom-footer' => __('Bottom footer')
                    ]),



                Forms\Components\TextInput::make('widget_id')
                    ->numeric(),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
                // dynmic compoennts

                Grid::make(1)
                    //->columnSpanFull()
                    ->schema(fn(Get $get) => WidgetsForms::getWidget($get('component'), $form))
                    ->key('componentsBuilder'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content')
                    ->searchable(),
                Tables\Columns\TextColumn::make('widget_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListHomeSections::route('/'),
            'create' => Pages\CreateHomeSection::route('/create'),
            'edit' => Pages\EditHomeSection::route('/{record}/edit'),
        ];
    }
    public static function getNavigationGroup(): string
    {
        return __('Theme content');
    }

}
