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
                        ])->columns(3),
                        FC\Section::make()
                        ->schema([
                            FC\TextInput::make('supported_porject'),
                            FC\TextInput::make('supported_project_type'),
                            
                        ])
                        ->columns(2)
                        ]),
                        FC\Tabs\Tab::make(__('Image'))
                        ->schema([
                                SpatieMediaLibraryFileUpload::make('avatar')
                                ->collection('supporters')

                            ])
                ])->columnSpanFull()
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
                TextColumn::make('supported_porject')
                ->label(__("Project")),
                TextColumn::make('supported_project_type')
                ->label(__("Project Type")),
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

    public static function getHeaderAction():array {
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
