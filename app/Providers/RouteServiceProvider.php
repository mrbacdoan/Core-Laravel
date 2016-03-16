<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     * @param Router $router
     * @param Request $request
     */
    public function map(Router $router, Request $request)
    {
        $router->pattern('slug', '[A-Za-z0-9-_]+');
        $router->pattern('id', '[0-9]+');

        $router->model('group', '\App\IZee\Groups\Group');
        $router->model('user', '\App\IZee\Users\User');
        $router->model('category', '\App\IZee\Categories\Category');

        /**
         * SET LANGUAGE
         */
        $locale = $request->segment(1);
        $locale = empty($locale) || !in_array($locale, config('app.locales')) ? App::getLocale() : $locale;
        define('LANGUAGE', $locale);
        define('LANG_PREFIX', $locale == config('app.locale') ? '' : $locale);
        if(!$request->is(API_PREFIX . '/*')){
            $this->app->setLocale($locale);
        }else{
            $this->app->setLocale('vi');
        }
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
