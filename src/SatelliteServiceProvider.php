<?php

namespace Statview\Satellite;

use Illuminate\Support\ServiceProvider;
use Statview\Satellite\Console\Commands\Heartbeat;

class SatelliteServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'statview',
        );

        $this->commands([
            Heartbeat::class,
        ]);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }
}