<?php

namespace Statview\Satellite\Tests;

use Statview\Satellite\SatelliteServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected $loadEnvironmentVariables = false;

    protected function getPackageProviders($app)
    {
        return [
            SatelliteServiceProvider::class,
        ];
    }
}
