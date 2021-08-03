<?php

namespace Hsy\Shopy;

use Illuminate\Support\ServiceProvider;

class HsyStoreServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->publishes([__DIR__ . '/../config/shopy.php' => config_path('shopy.php'),], 'config');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations')
        ], 'migrations');

        $this->registerFacades();
    }

    public function register()
    {

    }



    /**
     * Register any bindings to the app.
     *
     * @return void
     */
    protected function registerFacades()
    {
        $this->app->singleton('Shopy', function ($app) {
            return new StoreManager();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/shopy.php', 'shopy');
    }
}
