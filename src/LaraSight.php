<?php

namespace LaraSight\Satellite;

use Illuminate\Support\Facades\Http;
use LaraSight\Satellite\Widgets\Widget;

class LaraSight
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
                'Authorization' => 'Bearer ' . config('larasight.api_key'),
            ])
            ->post(config('larasight.endpoint') . '/api/timeline/' . config('larasight.project_id'), [
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