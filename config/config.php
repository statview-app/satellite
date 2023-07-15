<?php

return [
    'api_key' => env('STATVIEW_API_KEY'),

    'project_id' => env('STATVIEW_PROJECT_ID'),

    'monitors' => [
        'cron' => true,

        'queue' => true,
    ],

    'endpoint' => env('STATVIEW_ENDPOINT', 'https://statview.app'),
];
