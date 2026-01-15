<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\CloudStorage;
use App\Services\GoogleDriveStorage;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CloudStorage::class, function () {
            return new GoogleDriveStorage(
                app(\App\Services\GoogleDriveClient::class)
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
