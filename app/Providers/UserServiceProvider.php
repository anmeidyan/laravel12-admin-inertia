<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\UserService;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            UserServiceInterface::class,
            UserService::class
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
            UserServiceInterface::class,
        ];
    }
}
