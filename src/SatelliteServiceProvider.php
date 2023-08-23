<?php

namespace Statview\Satellite;

use Illuminate\Support\ServiceProvider;
use Statview\Satellite\Console\Commands\Heartbeat;
use Statview\Satellite\Console\Commands\TestWidgets;

class SatelliteServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'statview',
        );

        $this->commands([
            Heartbeat::class,
            TestWidgets::class,
        ]);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('statview.php'),
        ], 'statview-config');
    }
}