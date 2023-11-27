<?php

namespace Statview\Satellite\Features;

use Illuminate\Support\Facades\Http;
use Statview\Satellite\Feature;

class Gauge extends Feature
{
    public function increment(string $tag, int $count = 1): static
    {
        $this->callApi(
            tag: $tag,
            count: $count,
        );

        return $this;
    }

    public function decrement(string $tag, int $count = 1): static
    {
        $this->callApi(
            tag: $tag,
            count: $count,
            operation: 'decrement',
        );

        return $this;
    }

    private function callApi(string $tag, int $count, string $operation = 'increment'): void
    {
        $projectId = config('statview.project_id');

        try {
            $result = Http::statviewClient()
                ->post("gauge/{$operation}/{$projectId}/{$tag}", [
                    'count' => $count,
                ]);

            ray($result->status());
        } catch (\Exception $exception) {
            info($exception);
        }
    }
}
