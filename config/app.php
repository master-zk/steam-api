<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    */

    'name' => env('APP_NAME', 'Auth'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | 应用的默认语言
    |--------------------------------------------------------------------------
    |
    */

    'locale' => 'zh-CN',

    /*
    |--------------------------------------------------------------------------
    | 前端地址
    |--------------------------------------------------------------------------
    |
    */

    'frontend_url' => env('FRONTEND_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | 服务地址
    |--------------------------------------------------------------------------
    |
    */
    'api_url' => env('API_URL', 'http://127.0.0.1:8080'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    'version' => env('APP_VERSION', '1.0.0'),
];
