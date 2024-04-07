<?php

namespace App\Filament\Pages;

use App\Settings\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Pages\Concerns\HasTranslatableRecord;
use Filament\Actions;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Concerns\HasActiveLocaleSwitcher;
use ReflectionObject;
use Spatie\LaravelSettings\SettingsMapper;
use Spatie\LaravelSettings\SettingsConfig;
use Illuminate\Support\Str;

class MangeSite extends SettingsPage
{

    use Translatable, HasActiveLocaleSwitcher;
    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SiteSetting::class;

    // protected static ?string $model = null;


    // private SettingsMapper $settingsMapper;
    private SettingsConfig $config;



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
                            ->directory('site'),
                        FileUpload::make('header_bg')
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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $settings = app(static::$settings);

        // $props = $settings->getRepository()->
        foreach ($data as $key => $value) {
            // convert value to from json to array
            // get Translation
            $translation = $settings->getRepository()->getPropertyPayload('generalSetting', $key);

            // set Translation
            $translation[app()->getLocale()] = $value;

            // set $data[$key] to translation value

            $data[$key] = json_encode($translation, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // dump($data);

        return $data;
    }


    protected function mutateFormDataBeforeFill(array $data): array
    {
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return
            [
                Actions\LocaleSwitcher::make()
            ];
    }
}
