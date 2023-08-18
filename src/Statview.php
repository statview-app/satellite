<?php

namespace Statview\Satellite;

use Closure;
use Illuminate\Support\Facades\Http;
use Statview\Satellite\Enums\PostType;
use Statview\Satellite\Widgets\Widget;

class Statview
{
    protected static array|Closure $widgets = [];

    public static function registerWidgets(array|Widget|Closure $widgets): void
    {
        if (is_callable($widgets)) {
            static::$widgets = $widgets;

            return;
        }

        if (! is_array($widgets)) {
            $widgets = [$widgets];
        }

        static::$widgets = [
            ...static::$widgets,
            ...$widgets,
        ];
    }

    public static function postToTimeline(string $title, string $body, PostType $type = PostType::Default, ?string $icon = null): void
    {
        try {
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . config('statview.api_key'),
                ])
                ->post(config('statview.endpoint') . '/api/timeline/' . config('statview.project_id'), [
                    'title' => $title,
                    'body' => $body,
                    'type' => $type->value,
                    'icon' => $icon ?? $type->getIcon(),
                ]);
        } catch (\Exception $e) {
            info($e);
        }
    }

    public static function getWidgets(): array
    {
        $widgets = static::$widgets;

        if ($widgets instanceof Closure) {
            return $widgets();
        }

        return $widgets;
    }
}
