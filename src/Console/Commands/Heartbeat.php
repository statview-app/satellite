<?php

namespace LaraSight\Satellite\Console\Commands;

use Illuminate\Console\Command;
use LaraSight\Satellite\Jobs\PingCronMonitor;
use LaraSight\Satellite\Jobs\PingQueueMonitor;

class Heartbeat extends Command
{
    protected $signature = 'larasight:heartbeat';

    protected $description = 'Pings LaraSight';

    public function handle(): void
    {
        dispatch(new PingQueueMonitor());

        dispatch_sync(new PingCronMonitor());
    }
}
