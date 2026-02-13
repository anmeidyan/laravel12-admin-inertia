<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\AuthService;

class AuthServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            AuthServiceInterface::class,
            AuthService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function provides()
    {
        return [
            AuthServiceInterface::class,
        ];
    }
}
