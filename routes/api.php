<?php

use Illuminate\Support\Facades\Artisan;
use LaraSight\Satellite\Http\Middleware\ValidateRequest;

Route::get('/larasight/satellite/about', function () {
    Artisan::call('about --json');

    return [
        'data' => json_decode(Artisan::output(), true),
    ];
})->middleware(ValidateRequest::class);