<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'admin.partials.top-bar', 'App\Http\ViewComposers\AdminTopBarComposer'
        );

        view()->composer(
            ['admin.partials.sidebar-left', 'admin.partials.sidebar-right'], 'App\Http\ViewComposers\AdminSidebarComposer'
        );

        view()->composer(
            'frontend.search.type', 'App\IZee\ViewComposers\PopularPost'
        );

        view()->composer(
            'frontend.widgets.popular_heritages', 'App\IZee\ViewComposers\PopularHeritage'
        );

        view()->composer(
            'frontend.widgets.ads', 'App\IZee\ViewComposers\Adv'
        );

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}