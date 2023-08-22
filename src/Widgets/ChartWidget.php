<?php

namespace Statview\Satellite\Widgets;

class ChartWidget extends Widget
{
    public array $data = [];

    public string $type = 'line';

    public function type(string $type = 'line')
    {
        $this->type = $type;

        return $this;
    }

    public function data(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
