<?php

namespace Statview\Satellite\Widgets;

class Action
{
    public ?string $label = null;

    public ?string $icon = null;

    public ?string $url = null;

    public function __construct()
    {
    }

    public function label(?string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function icon(?string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function url(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public static function make(): static
    {
        return new static();
    }
}
