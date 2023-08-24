<?php

namespace Statview\Satellite\Console\Commands;

use Illuminate\Console\Command;
use Statview\Satellite\Jobs\PingQueueMonitorJob;

class PingQueueMonitor extends Command
{
    protected $signature = 'statview:ping-queue';

    protected $description = 'Pings Statview for the queue monitor.';

    public function handle(): void
    {
        dispatch(new PingQueueMonitorJob());
    }
}