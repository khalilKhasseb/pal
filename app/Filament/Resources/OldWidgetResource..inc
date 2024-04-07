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
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Str;
// form elements
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Builder as FilamentBuilder;
use Filament\Forms\Components\Component;
use Filament\Forms\Get;

//end form elements
//Tables
use Filament\Tables\Columns\TextColumn;

class WidgetResource extends Resource
{
    protected static ?string $model = Widget::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    /**
     * A function will be used to retrive all component names in component/wdiget dirctory
     *
     * @return array
     */
    public static function load_components(): array
    {

        // first retrive all files in a given path
        $components = [];
        $finder = app(Finder::class)->in(resource_path('views/components/widgets'))->name('*.blade.php');

        if ($finder->hasResults()) {
            // convert results to array
            // $result = iterator_to_array($finder, false);
            // dont make the the index of generator as index key of array will return a file instance
            foreach ($finder as $file) {
                $compnentNameWithoutExtention = explode('.', $file->getBasename())[0];

                $components["component-$compnentNameWithoutExtention"] = $compnentNameWithoutExtention;
            }
        }

        return $components;
    }
    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        TextInput::make('title')
                            ->label('title'),
                        Select::make('component')
                            ->label('Select Layout')
                            ->options(static::load_components())
                            ->live()
                            ->afterStateUpdated(fn (Select $component , $state) => $component
                            ->getContainer()
                            ->getComponent($state)
                            ->getChildComponentContainer()
                            ->fill()),
                        Select::make('location')
                            ->options([
                                'footer' => __('Footer'),
                                'homepage' => __('Homepage')
                            ]),

                        // dynmic compoennts
                        Grid::make()
                            ->columnSpanFull()
                            ->schema(fn (Get $get) => match ($get('component')) {
                                'component-link' => [static::link()]
                            })
                            ->key('component-link'),


                    ])
            ]);
    }



    // when selecting a component it should load the component form in order to create content
    // I'm going to use Builder in order to get JSON out but and build compoenent

    public static function link(): FilamentBuilder
    {
        return FilamentBuilder::make('content')
            ->blocks([
                FilamentBuilder\Block::make('heading')
                    ->schema([
                        TextInput::make('content')
                            ->label('Heading')
                            ->required(),
                        Select::make('level')
                            ->options([
                                'h1' => 'Heading 1',
                                'h2' => 'Heading 2',
                                'h3' => 'Heading 3',
                                'h4' => 'Heading 4',
                                'h5' => 'Heading 5',
                                'h6' => 'Heading 6',
                            ])
                            ->required(),
                    ])
                    ->columns(2),


            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title'),
                TextColumn::make('component')
                    ->label('Component')
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
            'index' => Pages\ListWidgets::route('/'),
            'create' => Pages\CreateWidget::route('/create'),
            'edit' => Pages\EditWidget::route('/{record}/edit'),
        ];
    }
}
