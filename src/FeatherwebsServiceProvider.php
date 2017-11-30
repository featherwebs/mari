<?php

namespace Featherwebs\Mari;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageServiceProvider;
use Zizaco\Entrust\EntrustServiceProvider;

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
            __DIR__ . '/views/layouts'      => base_path('resources/views/layouts'),
            __DIR__ . '/views/pages'        => base_path('resources/views/pages'),
            __DIR__ . '/views/partials'     => base_path('resources/views/partials'),
            __DIR__ . '/config'             => base_path('config'),
            __DIR__ . '/public'             => base_path('public'),
            __DIR__ . '/database/migrations'=> database_path('migrations'),
            __DIR__ . '/database/seeds'     => database_path('seeds'),
            __DIR__ . '/routes/routes.php'  => base_path('routes/web.php'),
        ]);
    }

    /**
     * Register the application services.
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/routes/admin.php';
        include __DIR__ . '/helpers/helpers.php';
        $this->app->register(ImageServiceProvider::class);
        $this->app->register(EntrustServiceProvider::class);
        //        $this->app->make('Featherwebs\Mari\Controllers');
    }
}
