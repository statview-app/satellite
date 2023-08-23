<?php

namespace Statview\Satellite\Console\Commands;

use Illuminate\Console\Command;
use Statview\Satellite\Statview;
use Statview\Satellite\Widgets\ChartWidget;

class TestWidgets extends Command
{
    protected $signature = 'statview:test-widgets';

    protected $description = 'Tests your widgets';

    public function handle(): void
    {
        $widgets = collect(Statview::getWidgets())
            ->map(fn ($widget) => ['title' => $widget->title, 'value' => $widget instanceof ChartWidget ? 'chart widget' : $widget->value])
            ->toArray();

        $this->table(['key', 'value'], $widgets);
    }
}