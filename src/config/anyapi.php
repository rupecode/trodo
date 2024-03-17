<?php

return [
    'base_url' => 'https://anyapi.io',
    'rates_url' => '/api/v1/exchange/rates',
    'api_key' => env('ANYAPI_KEY'),
    'currencies' => explode(',', env('ANYAPI_CURRENCIES', 'GBP,USD,AUD')),
];
