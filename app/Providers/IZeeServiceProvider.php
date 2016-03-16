<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class IZeeServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\IZee\Users\UserRepository', 'App\IZee\Users\DbUserRepository');
        $this->app->singleton('App\IZee\Admins\AdminRepository', 'App\IZee\Admins\DbAdminRepository');
        $this->app->singleton('App\IZee\Groups\GroupRepositoryInterface', 'App\IZee\Groups\DbGroupRepository');
        $this->app->singleton('App\IZee\Categories\CategoryRepositoryInterface', 'App\IZee\Categories\DbCategoryRepository');
    }
}