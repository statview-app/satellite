<?php

use Illuminate\Support\Facades\Artisan;
use LaraSight\Satellite\Http\Middleware\ValidateRequest;
use LaraSight\Satellite\LaraSight;

Route::get('/larasight/satellite/about', function () {
    Artisan::call('about --json');

    return [
        'data' => json_decode(Artisan::output(), true),
    ];
})->middleware(ValidateRequest::class);

Route::get('/larasight/satellite/stats', function () {
    return [
        'widgets' => LaraSight::getWidgets(),
    ];
})->middleware(ValidateRequest::class);