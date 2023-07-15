<?php

return [
    'api_key' => env('LARASIGHT_API_KEY'),

    'project_id' => env('LARASIGHT_PROJECT_ID'),

    'monitors' => [
        'cron' => true,

        'queue' => true,
    ],

    'endpoint' => env('LARASIGHT_ENDPOINT', 'https://larasight.app'),
];
