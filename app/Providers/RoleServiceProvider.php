<?php
/**
 * Created by Hoangnham
 * Date: 10/5/2015 4:03 PM
 */

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('IZeeRole', function () {
            return new \App\IZee\Core\Roles\Role;
        });
        $this->app->singleton('App\IZee\Core\Roles\RoleInterface', 'App\IZee\Core\Roles\Role');
    }
}
