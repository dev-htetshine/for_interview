<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Post\PostRepository::class,
            \App\Repositories\Post\PostEloquentRepository::class
        );

        $this->app->bind(
            \App\Repositories\User\UserRepository::class,
            \App\Repositories\User\UserEloquentRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
