<?php

namespace LaraSight\Satellite;

use Illuminate\Support\ServiceProvider;
use LaraSight\Satellite\Console\Commands\Heartbeat;

class SatelliteServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'larasight',
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