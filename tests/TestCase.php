<?php

namespace LaraSight\Satellite\Tests;

use LaraSight\Satellite\SatelliteServiceProvider;
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
