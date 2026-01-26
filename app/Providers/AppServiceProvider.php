<?php

namespace App\Providers;

use App\Listeners\RedirectAfterRegister;
use App\Services\AccessControl;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
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
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        Event::listen(
            RedirectAfterRegister::class,
        );

        Blade::if('registrationOpen', fn() => AccessControl::registrationOpen());
        Blade::if('abstractSubmissionOpen', fn() => AccessControl::abstractSubmissionOpen());
    }
}
