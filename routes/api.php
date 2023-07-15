<?php

use Illuminate\Support\Facades\Artisan;
use Statview\Satellite\Http\Middleware\ValidateRequest;
use Statview\Satellite\Statview;

Route::get('/statview/satellite/about', function () {
    Artisan::call('about --json');

    return [
        'data' => json_decode(Artisan::output(), true),
    ];
})->middleware(ValidateRequest::class);

Route::get('/statview/satellite/stats', function () {
    return [
        'widgets' => Statview::getWidgets(),
    ];
})->middleware(ValidateRequest::class);