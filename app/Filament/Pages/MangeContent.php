<?php

namespace App\Filament\Pages;

use App\Settings\ContentSettings;
use Filament\Forms;
use Filament\Forms\Components as fc;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class MangeContent extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = ContentSettings::class;
    public static function getNavigationGroup(): string
    {
        return __('Settings');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                fc\Section::make(__("About us: Concouil"))
                    ->schema([
                        fc\Textarea::make('c_about_ar')
                            ->label(__('About us Arabic')),
                        fc\Textarea::make('c_about_en')
                            ->label(__('About us Englis')),
                    ])->columns(2),
                fc\Section::make(__('About us : Sommod'))
                    ->schema([
                        fc\Textarea::make('s_about_ar')
                            ->label(__('About us Arabic')),
                        fc\Textarea::make('s_about_en')
                            ->label(__('About us Englis')),

                    ]),
                fc\Section::make(__('Section Sub Header content'))
                    ->schema([
                        fc\Textarea::make('news_ar')
                            ->label(__('Sub header Arabic News')),
                        fc\Textarea::make('news_en')
                            ->label(__('Sub header English News')),
                        fc\Textarea::make('contact_ar')
                            ->label(__('Sub header Arabic Contact us')),
                        fc\Textarea::make('contact_en')
                            ->label(__('Sub header English Contact us')),
                        fc\Textarea::make('donate_ar')
                            ->label(__('Sub header Arabic Donate')),
                        fc\Textarea::make('donate_en')
                            ->label(__('Sub header English Donate')),
                        fc\Textarea::make('partners_ar')
                            ->label(__('Sub header Arabic Partners')),
                        fc\Textarea::make('partners_en')
                            ->label(__('Sub header English Partners')),




                    ])->columns(2)
            ]);
    }
}
