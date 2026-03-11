<?php

namespace App\Providers;

use UniSharp\LaravelFilemanager\Events\ImageWasUploaded;
use UniSharp\LaravelFilemanager\Events\FileWasUploaded;
use UniSharp\LaravelFilemanager\Events\FileWasDeleted;
use UniSharp\LaravelFilemanager\Events\FileWasRenamed;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Services\MenuService;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (!request()->Is('admin-panel*')) {
            return;
        }

        $this->viewMenu(app(MenuService::class));
        $this->permission();
        $this->filemanager();
    }

    protected function viewMenu(MenuService $menuService): void
    {
        \View::composer('*', function ($view) use ($menuService) {
            if (!auth()->check()) return;

            $view->with('sideMenus', $menuService->getSideMenus());
        });
    }

    protected function permission(): void
    {
        Gate::before(function ($user, $ability) {
            if (!$user->role) return false;
            
            return $user->role->permissions->contains('slug', $ability);
        });
    }

    protected function filemanager(): void
    {
        $this->app->bind(
            \UniSharp\LaravelFilemanager\Controllers\DeleteController::class,
            \App\Http\Controllers\Admin\Filemanager\DeleteController::class
        );

        $this->app->bind(
            \UniSharp\LaravelFilemanager\Controllers\RenameController::class,
            \App\Http\Controllers\Admin\Filemanager\RenameController::class
        );
        
        $this->app->bind(
            \UniSharp\LaravelFilemanager\Controllers\UploadController::class,
            \App\Http\Controllers\Admin\Filemanager\UploadController::class
        );
    }
}
