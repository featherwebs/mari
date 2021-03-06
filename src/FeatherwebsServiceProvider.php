<?php

namespace Featherwebs\Mari;

use Featherwebs\Mari\Listeners\ImageDeleted;
use Featherwebs\Mari\Listeners\ImageRenamed;
use Featherwebs\Mari\Listeners\ImageUploaded;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageServiceProvider;
use JordanMiguel\LaravelPopular\LaravelPopularServiceProvider;
use Unisharp\Ckeditor\ServiceProvider as UnisharpServiceProvider;
use UniSharp\LaravelFilemanager\Events\ImageIsRenaming;
use UniSharp\LaravelFilemanager\Events\ImageWasDeleted;
use UniSharp\LaravelFilemanager\Events\ImageWasUploaded;
use Yajra\DataTables\DataTablesServiceProvider;
use Zizaco\Entrust\EntrustServiceProvider;
use Artesaos\SEOTools\Providers\SEOToolsServiceProvider;
use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;

class FeatherwebsServiceProvider extends ServiceProvider
{
    protected $listen = [
        ImageWasUploaded::class => [
            ImageUploaded::class,
        ],
        ImageIsRenaming::class  => [
            ImageRenamed::class
        ],
        ImageWasDeleted::class  => [
            ImageDeleted::class
        ],
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'featherwebs');
        //        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/views/layouts'        => base_path('resources/views/layouts'),
            __DIR__ . '/views/pages'          => base_path('resources/views/pages'),
            __DIR__ . '/views/posts'          => base_path('resources/views/posts'),
            __DIR__ . '/views/partials'       => base_path('resources/views/partials'),
            __DIR__ . '/config'               => base_path('config'),
            __DIR__ . '/public'               => base_path('public'),
            __DIR__ . '/routes/routes.php'    => base_path('routes/web.php'),
            __DIR__ . '/routes/mari.php'      => base_path('routes/mari.php'),
            __DIR__ . '/lang/en/messages.php' => resource_path('lang/en/messages.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/routes/admin.php';
        include __DIR__ . '/helpers/helpers.php';
        $this->app->register(ImageServiceProvider::class);
        $this->app->register(EntrustServiceProvider::class);
        $this->app->register(DataTablesServiceProvider::class);
        $this->app->register(UnisharpServiceProvider::class);
        $this->app->register(SEOToolsServiceProvider::class);
        $this->app->register(LaravelPopularServiceProvider::class);
        $this->app->register(DebugbarServiceProvider::class);
        //        $this->app->make('Featherwebs\Mari\Controllers');

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('SEO', \Artesaos\SEOTools\Facades\SEOTools::class);
        $loader->alias('SEOMeta', \Artesaos\SEOTools\Facades\SEOMeta::class);
        $loader->alias('OpenGraph', \Artesaos\SEOTools\Facades\OpenGraph::class);
        $loader->alias('Twitter', \Artesaos\SEOTools\Facades\TwitterCard::class);
        $loader->alias('Debugbar', Barryvdh\Debugbar\Facade::class);
    }
}
