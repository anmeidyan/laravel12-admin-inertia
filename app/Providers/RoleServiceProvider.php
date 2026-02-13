<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Services\Interfaces\RoleServiceInterface;
use App\Services\RoleService;

class RoleServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            RoleServiceInterface::class,
            RoleService::class
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
            RoleServiceInterface::class,
        ];
    }
}
