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
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Navigation\NavigationGroup;

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use LaraZeus\Sky\SkyPlugin;
use Filament\Navigation\MenuItem;
use Filament\Facades\Filament;
class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
       
        return $panel
            ->default()
            ->id('admin')
            ->path('admin') // where you change url of tha panel path making the app being accessiable without any prefix leave it emptyl ex: path('');
            ->login()
            ->colors([
                'primary' => Color::Green,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->brandName('Nebula Systems')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->userMenuItems([
               MenuItem::make()
               ->label(__('Sommod'))
               ->url(fn() => route('filament.sommod.pages.dashboard'))
            ])->navigationGroups([
                    __('Blog'),
                   __('Settings')
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

                SpatieLaravelTranslatablePlugin::make()->defaultLocales([config('app.locale'), 'en']),
                SkyPlugin::make()
                    ->navigationGroupLabel( __('Blog')),

            ])->default();
    }
}
