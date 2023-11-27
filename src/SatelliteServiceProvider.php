<?php

namespace Statview\Satellite;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Statview\Satellite\Console\Commands\Heartbeat;
use Statview\Satellite\Console\Commands\PingCronMonitor;
use Statview\Satellite\Console\Commands\PingQueueMonitor;
use Statview\Satellite\Console\Commands\TestWidgets;

class SatelliteServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/statview.php', 'statview',
        );

        $this->registerFeatures();

        $this->registerDsn();

        $this->registerHttpMacro();
    }

    public function boot()
    {
        $this->bootRoutes();

        if ($this->app->runningInConsole()) {
            $this->commands([
                PingCronMonitor::class,
                PingQueueMonitor::class,
                TestWidgets::class,
            ]);

            $this->publishes([
                __DIR__ . '/../config/statview.php' => config_path('statview.php'),
            ], 'statview-config');

            $this->bootChecks();
        }
    }

    private function registerFeatures(): void
    {

    }

    private function registerDsn(): void
    {
        if (!filled(config('statview.dsn'))) {
            return;
        }

        $parseUrl = parse_url(config('statview.dsn'));

        $items = explode('/', $parseUrl['path']);

        Config::set('statview.endpoint', $parseUrl['scheme'] . '://' . $parseUrl['host']);
        Config::set('statview.project_id', $items[1]);
        Config::set('statview.api_key', $items[2]);
    }

    private function registerHttpMacro(): void
    {
        Http::macro('statviewClient', function () {
            $http = Http::baseUrl(config('statview.endpoint') . '/api/')
                ->withHeaders([
                    'Authorization' => 'Bearer ' . config('statview.api_key'),
                ]);

            if (config('app.env') === 'local') {
                $http->withoutVerifying();
            }

            return $http;
        });
    }

    private function bootRoutes(): void
    {
        Route::group([
            'domain' => config('statview.domain'),
            'prefix' => config('statview.path'),
            'middleware' => config('statview.middleware'),
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
    }

    private function bootChecks(): void
    {
        if (config('statview.monitors.cron')) {
            $this->app->afterResolving(Schedule::class, static function (Schedule $schedule) {
                $schedule
                    ->command(PingCronMonitor::class)
                    ->everyMinute();
            });
        }

        if (config('statview.monitors.queue')) {
            $this->app->afterResolving(Schedule::class, static function (Schedule $schedule) {
                $schedule
                    ->command(PingQueueMonitor::class)
                    ->everyMinute();
            });
        }
    }
}
