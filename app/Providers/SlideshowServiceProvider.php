<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Services\Interfaces\SlideshowServiceInterface;
use App\Services\SlideshowService;

class SlideshowServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            SlideshowServiceInterface::class,
            SlideshowService::class
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
            SlideshowServiceInterface::class,
        ];
    }
}
