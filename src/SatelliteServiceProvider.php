<?php

namespace LaraSight\Satellite;

use Illuminate\Support\ServiceProvider;
use LaraSight\Satellite\Widgets\Widget;

class SatelliteServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'larasight',
        );
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }
}