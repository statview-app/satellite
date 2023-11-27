<?php

namespace Statview;

use Statview\Satellite\Features\Gauge;
use Statview\Satellite\Statview;

function gauge(): Gauge
{
    return app(Statview::class)->gauge();
}