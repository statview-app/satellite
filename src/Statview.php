<?php

namespace Statview\Satellite;

use Illuminate\Support\Facades\Http;
use Statview\Satellite\Widgets\Widget;

class Statview
{
    protected static array $widgets = [];

    public static function registerWidgets(array|Widget $widgets): void
    {
        if (! is_array($widgets)) {
            $widgets = [$widgets];
        }

        static::$widgets = [
            ...static::$widgets,
            ...$widgets,
        ];
    }

    public static function postToTimeline(string $title, string $body, string $type = 'info', string $icon = '📣'): void
    {
        $response = Http::withoutVerifying()
            ->withHeaders([
                'Authorization' => 'Bearer ' . config('statview.api_key'),
            ])
            ->post(config('statview.endpoint') . '/api/timeline/' . config('statview.project_id'), [
                'title' => $title,
                'body' => $body,
                'type' => $type,
                'icon' => $icon,
            ]);
    }

    public static function getWidgets(): array
    {
        return static::$widgets;
    }
}