<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Master activity logging
    |--------------------------------------------------------------------------
    */

    'enabled' => env('MASTERLOG_ENABLED', true),

    /*
    | Log GET requests as well (can be noisy). Mutating methods are always logged.
    */
    'log_get' => env('MASTERLOG_LOG_GET', false),

    /*
    | Paths (prefix match, lowercase, leading slash) that should never be logged.
    */
    'exclude_paths' => [
        '/up',
        '/sanctum',
        '/_debugbar',
        '/telescope',
        '/horizon',
        '/livewire',
        '/vendor',
        '/storage',
        '/css',
        '/js',
        '/images',
        '/fonts',
        '/favicon',
        '/manager/admin/dashboard/master-logs',
        '/api/documentation',
        '/docs',
    ],

    /*
    | Route name prefixes to skip.
    */
    'exclude_route_prefixes' => [
        'manager.master-logs.',
        'debugbar.',
    ],
];
