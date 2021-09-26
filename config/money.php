<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel money
     |--------------------------------------------------------------------------
     */
    'locale' => config('app.locale', 'en_US'),
    'defaultCurrency' => config('app.currency', 'USD'),
    'currencies' => [
        'iso' => ['USD', 'EUR', 'GBP'],
        'bitcoin' => [],
        'custom' => [
            // 'MY1' => 2,
            // 'MY2' => 3
        ]
    ]
];
