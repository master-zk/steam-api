<?php

return [
    'endpoint' => [
        'driver' => env('JSON_RPC_DRIVER_ENDPOINT', ''),
        'manager' => env('JSON_RPC_EMPLOYEE_ENDPOINT', ''),
        'passenger' => env('JSON_RPC_PASSENGER_ENDPOINT', ''),
    ],
];
