<?php

namespace Statview\Satellite\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class PingCronMonitor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function handle()
    {
        $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('statview.api_key'),
            ])
            ->post(config('statview.endpoint') . '/api/ping/cron/' . config('statview.project_id'));
    }
}