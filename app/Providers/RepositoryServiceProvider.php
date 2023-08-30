<?php

namespace App\Providers;

use App\Repositories\Eloquent\PostEloquentRepository;
use App\Repositories\Eloquent\UserEloquentRepository;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostEloquentRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserEloquentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
