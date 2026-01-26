<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AccessControl;
use App\Services\AppSetting;

class AccessControlServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Appsetting::class, function () {
            return new AppSetting();
        });

        $this->app->singleton(AccessControl::class, function ($app) {
            return new AccessControl(
                $app->make(AppSetting::class)
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
