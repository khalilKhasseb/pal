<?php

namespace App\Filament\Pages;

use App\Settings\GateWaySettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components as FC;

class MangeGateWay extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GateWaySettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FC\TextInput::make('version')
                    ->label(__('Version')),
                FC\TextInput::make('merchant_id')
                    ->label(__('merchant id')),
                FC\TextInput::make('merchant_password')
                    ->label(__('merchant_password')),
                FC\TextInput::make('acquire_id')
                    ->label(__('acquire_id')),
                FC\TextInput::make('callback_url')
                    ->label(__('callback_url')),
                FC\TextInput::make('autorize_url')
                    ->label(__('autorize_url')),

                FC\TextInput::make('currency_code')
                    ->label(__('currency_code')),

                FC\TextInput::make('currency_exp')
                    ->label(__('currency_exp')),

                FC\TextInput::make('capture_flag')
                    ->label(__('capture_flag')),

                FC\TextInput::make('signture_method')
                    ->label(__('signture_method')),

            ]);
    }
}
