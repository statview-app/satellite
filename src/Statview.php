<?php

namespace Statview\Satellite;

use Closure;
use Exception;
use Illuminate\Support\Facades\Http;
use Statview\Satellite\Enums\PostType;
use Statview\Satellite\Widgets\Action;
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

    public static function postToTimeline(string $title, string $body, PostType $type = PostType::Default, ?string $icon = null, array $actions = []): void
    {
        $wrongFormat = array_filter($actions, fn (mixed $action) => ! $action instanceof Action);

        if (filled($wrongFormat)) {
            throw new Exception('Timeline item action wrong type.');
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('statview.api_key'),
            ])
            ->post(config('statview.endpoint') . '/api/timeline/' . config('statview.project_id'), [
                'title' => $title,
                'body' => $body,
                'type' => $type->value,
                'icon' => $icon ?? $type->getIcon(),
                'actions' => $actions,
            ]);
        } catch (Exception $e) {
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
