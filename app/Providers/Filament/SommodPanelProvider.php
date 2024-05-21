<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use LaraZeus\Sky\SkyPlugin;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Navigation\MenuItem;
use Filament\Facades\Filament;

class SommodPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('sommod')
            ->path('sommod')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->brandName('Nebula Systems')
            ->discoverResources(in: app_path('Filament/Sommod/Resources'), for: 'App\\Filament\\Sommod\\Resources')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Sommod/Pages'), for: 'App\\Filament\\Sommod\\Pages')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Sommod/Widgets'), for: 'App\\Filament\\Sommod\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])->userMenuItems([
                MenuItem::make()
                ->label(__('Concile'))
                ->url(fn() => route('filament.admin.pages.dashboard'))
             ])
            ->authGuard('system')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])->plugins([

                SpatieLaravelTranslatablePlugin::make()->defaultLocales(['en', 'ar']),
                SkyPlugin::make()
                    ->navigationGroupLabel('Blog'),

            ]);
    }
}
