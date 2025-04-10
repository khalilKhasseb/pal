<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WidgetResource\Pages;
use App\Filament\Resources\WidgetResource\RelationManagers;
use App\Models\Widget;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

//Resource Helpers
use Symfony\Component\Finder\Finder;
//######//

//Form Component
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Builder as FilamentBuilder;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Component;
use Filament\Forms\Get;
use Filament\Forms\Set;

//#######//


use App\Classes\WidgetsForms;
use Filament\Facades\Filament;
// tables
use Filament\Tables\Columns\TextColumn;
//#####//
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\TextInputColumn;

class WidgetResource extends Resource
{
    use Translatable;
    protected static ?string $model = Widget::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static Form  $formInncatnce;

    public static function canAccess(): bool
    {
        return true;
    }

    public static function getLabel(): string
    {
        return __("Widget");
    }

    public static function getPluralLabel(): string
    {
        return __('Widgets');
    }
    public static function form(Form $form): Form
    {
        static::$formInncatnce = $form;

        return $form
            ->schema([
                Grid::make(4)
                    ->schema([
                        TextInput::make('title')
                            ->label(__('Title')),
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

                        TextInput::make('order')
                            ->numeric()
                            ->label(__('Order')),
                        Select::make(__('Panel'))
                            ->multiple()
                            ->relationship('panels', titleAttribute: 'panel_name')
                            ->preload(),

                        // dynmic compoennts
                        Grid::make(1)
                            //->columnSpanFull()
                            ->schema(fn(Get $get) => WidgetsForms::getWidget($get('component'), $form))
                            ->key('componentsBuilder'),


                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        // dd(Filament::getPanels());
        return $table
            ->columns([
                TextColumn::make('title')->label(__('Title')),
                TextColumn::make('component')->label(__('layout')),
                TextColumn::make('location')->label(__("Location")),
                TextInputColumn::make('order')->label(__('Order')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
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
            'index' => Pages\ManageWidgets::route('/'),
        ];
    }

    public static function getNavigationGroup(): string
    {
        return __('Theme content');
    }




    // Resource privet behivor



    // Components


}
