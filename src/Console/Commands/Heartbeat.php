<?php

namespace Statview\Satellite\Console\Commands;

use Illuminate\Console\Command;
use Statview\Satellite\Jobs\PingCronMonitor;
use Statview\Satellite\Jobs\PingQueueMonitor;

class Heartbeat extends Command
{
    protected $signature = 'statview:heartbeat';

    protected $description = 'Pings Statview';

    public function handle(): void
    {
        dispatch(new PingQueueMonitor());

        dispatch_sync(new PingCronMonitor());
    }
}
