<?php

namespace Statview\Satellite\Http\Controllers;

use Illuminate\Routing\Controller;
use Statview\Satellite\Statview;

class StatsController extends Controller
{
    public function __invoke()
    {
        return [
            'widgets' => Statview::getWidgets(),
        ];
    }
}