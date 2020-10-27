<?php

namespace Hsy\Store\Tests;

use Hsy\Store\HsyStoreServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

//        $this->withFactories(__DIR__.'/../database/factories');
    }

    /**
     * Bootstrap any service providers here.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            HsyStoreServiceProvider::class,
        ];
    }

    /**
     * Bootstrap any aliases here.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Press' => 'Hsy\\Store\\Facades\\Store',
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
       /* // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
        ]);
        $app['config']->set('press.prefix', '');
        $app['config']->set('press.driver', 'file');*/
    }
}