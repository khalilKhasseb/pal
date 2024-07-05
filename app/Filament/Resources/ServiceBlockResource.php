<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceBlockResource\Pages;
use App\Models\ServiceBlock;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Filament\Forms\Get;
use Filament\Forms\Set;

class ServiceBlockResource extends Resource
{
    use \App\Traits\ConcielAccess;
    protected static ?string $model = ServiceBlock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('title'))
                    ->required()
                    ->columnSpanFull()
                ,
                Forms\Components\RichEditor::make('content')
                    ->label(__('Post Content'))
                    ->columnSpanFull()
                    ->required()
                ,
                Forms\Components\Placeholder::make('image_type')
                    ->label(__('Image Type')),
                Forms\Components\ToggleButtons::make('image_type_option')
                    ->label(__('Image type option'))
                    ->live()
                    ->options([
                        'icon' => __('Icon'),
                        'image' => __('Image')
                    ])->grouped()->default('image')->columnSpan(2),
                IconPicker::make('icon')
                    ->label(__('Icon'))
                    ->visible(fn(Get $get) => $get('image_type_option') === 'icon')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('service_image')
                    ->collection('service_block')
                    ->visible(fn(Get $get) => $get('image_type_option') === 'image')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title'))
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
            'index' => Pages\ManageServiceBlocks::route('/'),
        ];
    }
    public static function getNavigationLabel(): string {
        return __('Services Blocks');
    }

    public static function getNavigationGroup(): string
    {
        return __('Theme content');
    }

}
