<?php

namespace LaraSight\Satellite;

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

    public static function getWidgets(): array
    {
        return static::$widgets;
    }
}