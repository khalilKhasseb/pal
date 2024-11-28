<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpertResource\Pages;
use App\Filament\Resources\ExpertResource\RelationManagers;
use App\Models\Expert;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components as fc;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Forms\Get;
use App\Models\Governorate;
use TomatoPHP\FilamentMediaManager\Form\MediaManagerInput;

class ExpertResource extends Resource
{
    protected static ?string $model = Expert::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')->schema([

                    MediaManagerInput::make('image')
                        ->label(__('Persoanl Images'))
                        ->schema(\App\Classes\MediaManagerInputForm::schema()),

                    Forms\Components\TextInput::make('sir_name_ar')
                        ->label('Sir Name (Arabic)')
                        ->required(),

                    Forms\Components\TextInput::make('sir_name_en')
                        ->label('Sir Name (English)')
                        ->required(),

                    Forms\Components\Select::make('gender')
                        ->options([
                            'male' => 'Male',
                            'female' => 'Female',
                        ])
                        ->required(),

                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required(),

                    Forms\Components\TextInput::make('mobile_number')
                        ->label('Mobile Number')
                        //->tel()
                        ->required(),

                    fc\Select::make('governorate_id')
                        ->relationship('governorate', titleAttribute: 'name')
                        ->getOptionLabelFromRecordUsing(fn($record) => $record->name)
                        ->preload()
                        ->searchable()
                        ->label(__('Governorate'))
                        ->live(),
                    fc\Select::make('city_id')
                        ->options(function (Get $get) {
                            if ($get('governorate_id') && Governorate::find($get('governorate_id'))) {
                                return Governorate::find($get('governorate_id'))->cities->pluck('name', 'id');
                            }

                            return [];
                        })
                        ->preload()
                        ->searchable()
                        ->label(__('City/Vilage'))
                        ->required(),


                    Forms\Components\DatePicker::make('date_of_birth')
                        ->label('Date of Birth')
                        ->required(),
                ])->columns(2),


                Forms\Components\Section::make('Academic Information')->schema([
                    Forms\Components\TextInput::make('university')
                        ->required(),

                    Forms\Components\TextInput::make('ba_major')
                        ->label('BA Major')
                        ->required(),

                    Forms\Components\TextInput::make('graduation_year')
                        ->label('Graduation Year')
                        ->numeric()
                        ->required(),
                    Forms\Components\TextInput::make('phd_degrees')
                        ->label('PHD Degrees'),

                ])->columns(2),

                Forms\Components\Repeater::make('certificates')
                    ->relationship('certificates') // Defines the relationship
                    ->schema([
                        Forms\Components\TextInput::make('certificate_name')
                            ->label('Certificate Name')
                            ->required(),

                        Forms\Components\TextInput::make('certifying_authority')
                            ->label('Certifying Authority')
                            ->required(),

                        Forms\Components\TextInput::make('authenticate_certificate_url')
                            ->label('Authentication URL'),

                        Forms\Components\FileUpload::make('attachment_certification')
                            ->label('Attachment Certification'),

                        Forms\Components\TextInput::make('certification_experience')
                            ->label('Certification Experience (Years)')
                            ->numeric(),
                    ])
                    ->label('Certificates')
                    ->required()
                    ->columns(1)
                , // Two columns layout for the fields
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sir_name_en')->label('Sir Name (English)'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('mobile_number')->label('Mobile Number'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                \Filament\Infolists\Components\ImageEntry::make('image')
                   ->getStateUsing(fn ($record) => $record?->getMedia('image')?->first()?->getUrl()) ,

                \Filament\Infolists\Components\Fieldset::make('expert_information')
                    ->schema([
                        Infolists\Components\TextEntry::make('sir_name_ar')
                            ->label('Sir Name (Arabic)'),

                        Infolists\Components\TextEntry::make('sir_name_en')
                            ->label('Sir Name (English)'),

                        Infolists\Components\TextEntry::make('gender')
                            ->label('Gender'),

                        Infolists\Components\TextEntry::make('email')
                            ->label('Email'),

                        Infolists\Components\TextEntry::make('mobile_number')
                            ->label('Mobile Number'),

                        Infolists\Components\TextEntry::make('city_id')
                            ->label('City or Village'),

                        Infolists\Components\TextEntry::make('governorate')
                            ->label('Governorate'),

                        Infolists\Components\TextEntry::make('date_of_birth')
                            ->label('Date of Birth'),

                    ]),
                // Expert Information
                \Filament\Infolists\Components\Fieldset::make('expert_education_information')
                    ->schema([
                        Infolists\Components\TextEntry::make('university')
                            ->label('University'),

                        Infolists\Components\TextEntry::make('ba_major')
                            ->label('BA Major'),

                        Infolists\Components\TextEntry::make('graduation_year')
                            ->label('Graduation Year'),
                        Infolists\Components\TextEntry::make('phd_degrees')
                            ->label('PHD Degrees'),

                    ]),

                // Certificates (Relationship)
                \Filament\Infolists\Components\Section::make('certificates')
                    ->schema(
                        [
                            Infolists\Components\RepeatableEntry::make('certificates')
                                // ->relationship('certificates') // Ties the repeater to the certificates relation
                                ->schema([
                                    Infolists\Components\TextEntry::make('certificate_name')
                                        ->label('Certificate Name'),

                                    Infolists\Components\TextEntry::make('certifying_authority')
                                        ->label('Certifying Authority'),

                                    Infolists\Components\TextEntry::make('authenticate_certificate_url')
                                        ->label('Authentication URL'),
                                    //->url(),

                                    Infolists\Components\TextEntry::make('attachment_certification')
                                        ->label('Attachment Certification'),

                                    Infolists\Components\TextEntry::make('certification_experience')
                                        ->label('Certification Experience (Years)'),
                                ])
                                ->label('Certificates')
                                ->columns(2),
                        ]
                    ),

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
            'index' => Pages\ListExperts::route('/'),
            'create' => Pages\CreateExpert::route('/create'),
            'edit' => Pages\EditExpert::route('/{record}/edit'),
            'view' => Pages\ViewExpert::route('/{record}'),
        ];
    }
}
