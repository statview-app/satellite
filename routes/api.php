<?php

Route::prefix('/statview/satellite')
    ->middleware([
        \Statview\Satellite\Http\Middleware\ValidateRequest::class,
    ])
    ->group(function () {
        Route::get('about', \Statview\Satellite\Http\Controllers\AboutController::class);

        Route::get('stats', \Statview\Satellite\Http\Controllers\StatsController::class);

        Route::post('toggle-maintenance', \Statview\Satellite\Http\Controllers\MaintenanceController::class);
    });
