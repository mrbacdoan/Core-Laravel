<?php
/**
 * Created by Hoangnham
 * Date: 10/9/2015 9:56 AM
 */

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
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
        App::bind('IZeeAPIAdmin', function () {
            return new \App\IZee\Core\Admin\Admin();
        });
        $this->app->singleton('App\IZee\Core\Admin\Interfaces\Admin', 'App\IZee\Core\Admin\Admin');
    }
}
