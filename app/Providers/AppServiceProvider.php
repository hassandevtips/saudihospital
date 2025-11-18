<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\GeneralTranslation;
use Illuminate\Support\Facades\View;

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
        // Helper For General Translations
        View::composer('*', function ($view) {
            $view->with('gt', function ($key, $default = null, $locale = null) {
                return GeneralTranslation::get($key, $locale, $default);
            });
        });
    }
}
