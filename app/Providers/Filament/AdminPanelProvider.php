<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Gate; // Import Gate
use App\Enums\UserRole; // Import your Enum
// 1. Import these two classes
use Filament\Actions\ImportAction as PageImportAction; 
use Filament\View\PanelsRenderHook; // Import this
use Illuminate\Support\Facades\Blade; // Import this
class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                fn (): string => Blade::render(<<<'BLADE'
                    @php
                        $user = auth()->user();
                        $color = match($user?->role) {
                            \App\Enums\UserRole::ADMIN => 'text-custom-600 bg-custom-50 ring-custom-600/20', // Handled via style below
                            \App\Enums\UserRole::VIEWER => 'text-gray-600 bg-gray-50 ring-gray-500/10',
                            default => 'text-gray-600 bg-gray-50 ring-gray-500/10',
                        };
                        
                        $roleLabel = $user?->role?->name ?? 'Guest';
                    @endphp

                    <div class="flex items-center justify-center gap-x-2 mr-4">
                        <span class="
                            inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset
                            {{ $user?->role === \App\Enums\UserRole::ADMIN ? 'bg-emerald-50 text-emerald-700 ring-emerald-600/20' : '' }}
                            {{ $user?->role === \App\Enums\UserRole::VIEWER ? 'bg-blue-50 text-blue-700 ring-blue-700/10' : '' }}
                        ">
                            {{ ucfirst(str_replace('_', ' ', $user?->role?->value)) }}
                        </span>
                    </div>
                BLADE)
                    )
            ->brandLogo(asset('images/logo.png'))
            ->brandName('HELVETAS WSMIS')
            ->userMenuItems([
                Action::make('settings')
                    ->icon('heroicon-o-cog-6-tooth')->url('/admin/settings'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
            ])
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
            ]);
    }

    public function boot(): void
    {
        // 1. Define Global Rules
        Gate::before(function ($user, $ability) {
            
            // RULE A: Super Admins can do EVERYTHING (God Mode)
            if ($user->role === UserRole::ADMIN) {
                return true; 
            }

            // RULE B: Viewers can ONLY see (Read Only Mode)
            if ($user->role === UserRole::VIEWER) {
                // If the action is "view" or "viewAny", allow it globally.
                if (in_array($ability, ['view', 'viewAny'])) {
                    return true;
                }
                
                // For any other action (create, update, delete, restore, etc.), BLOCK it.
                return false; 
            }

            // RULE C: Everyone else (Admin/Editor) falls back to the specific Model Policy
            return null; 

            
        });

        PageImportAction::configureUsing(function (PageImportAction $action) {
            $action->hidden(fn () => auth()->user()?->role === UserRole::VIEWER);
        });

    }
}
