<?php

namespace App\Filament\Pages;

use App\Settings\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Fieldset;

class MangeSite extends SettingsPage
{
    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SiteSetting::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make(__('Site General'))
                    ->schema([
                        TextInput::make('site_name')
                            ->suffixIcon('heroicon-m-globe-alt'),
                        TextInput::make('site_description')
                            ->suffixIcon('heroicon-o-document-text'),
                        FileUpload::make('site_logo')
                            ->image()
                            ->imageEditor()
                            ->directory('site')
                    ])

            ]);
    }


    public static function getNavigationLabel(): string
    {
        return __('Site Settings');
    }
}
