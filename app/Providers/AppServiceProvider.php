<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('vn_phone_number', function($attribute, $value, $parameters, $validator) {
            return VICheckPhoneNumber($value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->environment() == 'local'){
            $this->app->register('PhucPM\Generators\GeneratorsServiceProvider');
        }
    }
}
