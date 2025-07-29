<?php

return [
    'cache' => [
        'enabled' => true,
        'default_ttl' => 60,
        'store' => env('QUICKSILVER_CACHE_STORE', 'redis'),
        'compress' => true,
        'compression_level' => 6,
    ],
    
    'chunk' => [
        'default_size' => 1000,
        'memory_threshold' => 50, // MB
    ],
    
    'eager_load' => [
        'detect_n_plus_one' => true,
        'log_missing' => true,
        'auto_fix' => env('APP_ENV') === 'local',
    ],
    
    'explain' => [
        'enabled' => env('APP_ENV') !== 'production',
        'threshold_ms' => 500,
    ],
    
    'index_advisor' => [
        'enabled' => true,
        'min_occurrences' => 3,
    ],
    
    'memory' => [
        'monitoring' => [
            'enabled' => env('QUICKSILVER_MEMORY_MONITORING', false),
            'warning_threshold_mb' => 50,
        ]
    ]
];