<?php

namespace Statview\Satellite\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;

class AboutController extends Controller
{
    public function __invoke()
    {
        Artisan::call('about --json');

        return [
            'data' => json_decode(Artisan::output(), true),
        ];
    }
}