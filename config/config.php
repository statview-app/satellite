<?php

return [
    'api_key' => env('STATVIEW_API_KEY'),

    'project_id' => env('STATVIEW_PROJECT_ID'),

    'monitors' => [
        'cron' => true,

        'queue' => true,
    ],

    'endpoint' => env('STATVIEW_ENDPOINT', 'https://statview.app'),

    'whitelisted_ips' => ['128.140.60.157', '127.0.0.1'],

    'strict' => env('STATVIEW_STRICT', true),
];
