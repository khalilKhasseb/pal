<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GallaryResource\Pages;
use App\Filament\Resources\GallaryResource\RelationManagers;
use App\Models\Gallary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Concerns\Translatable;
use TomatoPHP\FilamentMediaManager\Form\MediaManagerInput;
class GallaryResource extends Resource
{
    use Translatable;
    protected static ?string $model = Gallary::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                ->label(__('Title'))
                ->required(),
                Forms\Components\Select::make('panel')
                ->multiple()
                ->relationship('panels' , titleAttribute:'panel_name'),
                Forms\Components\Toggle::make('show_in_slider')
                ->label(__('Show in slider')),
                MediaManagerInput::make('gallary')
                ->label(__('Gallary Images'))
                ->schema(\App\Classes\MediaManagerInputForm::schema())
                //->multiple()
                // ->collection('gallary')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                ->label(__('Title')),
                Tables\Columns\TextColumn::make('panels.panel_name')
                ->label(__("Panel")),
                Tables\Columns\ToggleColumn::make('show_in_slider')
                ->label(__('show in slider'))
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
            'index' => Pages\ListGallaries::route('/'),
            'create' => Pages\CreateGallary::route('/create'),
            'edit' => Pages\EditGallary::route('/{record}/edit'),
        ];
    }

 public static function getNavigationLabel(): string
  {
        return __('Gallaries');
  }
}
