<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Filament::serving(function () {
        //     Filament::registerRenderHook(
        //         'filament.brand.start',
        //         fn() => view('filament.components.brand')
        //     );
        // });

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }

}
