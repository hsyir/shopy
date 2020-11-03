<?php

namespace Hsy\Store;

use Illuminate\Support\ServiceProvider;

class HsyStoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
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
        $this->app->singleton('Store', function ($app) {
            return new StoreManager();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/store.php', 'store');
    }
}
