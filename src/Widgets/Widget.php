<?php

namespace Statview\Satellite\Widgets;

class Widget
{
    public ?string $code = null;

    public ?string $title = null;

    public mixed $value = null;

    public ?string $description = null;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function title(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function value(mixed $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function description(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public static function make(string $code): static
    {
        return new static($code);
    }
}