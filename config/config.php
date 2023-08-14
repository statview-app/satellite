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

    'services' => [
        'cloudflare_ips' => [
            '173.245.48.0',
            '103.21.244.0',
            '103.22.200.0',
            '103.31.4.0',
            '141.101.64.0',
            '108.162.192.0',
            '190.93.240.0',
            '188.114.96.0',
            '197.234.240.0',
            '198.41.128.0',
            '162.158.0.0',
            '104.16.0.0',
            '104.24.0.0',
            '172.64.0.0',
            '131.0.72.0',
        ],
    ],
];