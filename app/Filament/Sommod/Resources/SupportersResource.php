<?php

namespace App\Filament\Sommod\Resources;

use App\Filament\Sommod\Resources\SupportersResource\Pages;
use App\Filament\Sommod\Resources\SupportersResource\RelationManagers;
// use App\Filament\Sommod\Resources\SupportersResource\RelationManagers\InitiativesRelationManager;
use App\Models\Supporter;
use Filament\Actions\LocaleSwitcher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components as FC;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class SupportersResource extends Resource
{
    use Translatable;
    protected static ?string $model = Supporter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationLabel(): string
    {
        return __("Supporters");
    }

    public static function getModelLabel(): string
    {
        return __("Supporter");
    }

    public static function getPluralLabel(): string
    {
        return __("Supporters");
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FC\Tabs::make(__('Supporters'))
                    ->tabs([
                        FC\Tabs\Tab::make(__('Supporter Information'))
                            ->schema([
                                FC\Section::make()
                                    ->schema([
                                        FC\TextInput::make('name')
                                            ->label(__("Name")),
                                        FC\TextInput::make('location')
                                            ->label(__("Location")),
                                        FC\TextInput::make('phone')
                                            ->label(__("Phone")),
                                        FC\RichEditor::make('about')
                                            ->label(__("About"))
                                            ->columnSpanFull(),
                                        FC\TextInput::make('website')
                                            ->label(__('Website'))
                                            ->columnSpanFull()
                                    ])->columns(3),
                                FC\Section::make()
                                    ->schema([
                                        FC\Select::make('supported_porject')
                                            ->relationship(name: 'supported_projects', titleAttribute: 'name')
                                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
                                            ->preload()
                                            ->multiple(),
                                        FC\Select::make('supported_project_types')
                                            ->relationship(name: 'supported_project_types', titleAttribute: 'name')
                                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
                                            ->preload()
                                            ->multiple()

                                    ])
                                    ->columns(2)
                            ]),
                        FC\Tabs\Tab::make(__('Image'))
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('avatar')
                                    ->collection('supporters')

                            ])
                    ])->columnSpanFull(),
                FC\Select::make(__('Panel'))
                    ->multiple()
                    ->relationship('panels', titleAttribute: 'panel_name')
                    ->preload()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__("Name")),
                TextColumn::make('location')
                    ->label(__("Location")),
                TextColumn::make('phone')
                    ->label(__("Phone")),
                TextColumn::make('supported_projects.name')
                    ->label(__("Supported Project")),
                TextColumn::make('supported_project_types.name')
                    ->label(__("Supported Project Type")),
                TextColumn::make('panels.panel_name')
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

    public static function getRelations(): array
    {
        return [
            RelationManagers\InitiativesRelationManager::make()
        ];
    }

    public static function getHeaderAction(): array
    {
        return [
            LocaleSwitcher::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSupporters::route('/'),
            'create' => Pages\CreateSupporters::route('/create'),
            'edit' => Pages\EditSupporters::route('/{record}/edit'),
        ];
    }
}
