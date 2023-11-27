<?php

namespace Statview\Satellite;

class Feature
{
    protected ?Statview $statview;

    public function __construct(Statview $statview)
    {
        $this->statview = $statview;
    }
}