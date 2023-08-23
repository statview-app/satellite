<?php

namespace Statview\Satellite\Console\Commands;

use Illuminate\Console\Command;
use Statview\Satellite\Jobs\PingCronMonitorJob;

class PingCronMonitor extends Command
{
    protected $signature = 'statview:ping-cron';

    protected $description = 'Pings Statview for the cron monitor.';

    public function handle(): void
    {
        dispatch_sync(new PingCronMonitorJob());
    }
}