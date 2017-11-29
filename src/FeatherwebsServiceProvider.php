<?php

namespace Featherwebs\Mari;

use Illuminate\Support\ServiceProvider;

class FeatherwebsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'featherwebs');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/views/layouts'  => base_path('resources/views/layouts'),
            __DIR__ . '/views/pages'    => base_path('resources/views/pages'),
            __DIR__ . '/views/partials' => base_path('resources/views/partials'),
            __DIR__ . '/config'         => base_path('config'),
            __DIR__ . '/public'         => base_path('public'),
        ]);
    }

    /**
     * Register the application services.
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/routes.php';
        include __DIR__ . '/helpers/helpers.php';
        //        $this->app->make('Featherwebs\Mari\Controllers');
    }
}
