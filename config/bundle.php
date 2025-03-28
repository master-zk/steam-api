<?php

return [
    'internal' => [
        'ip_white_list' => env('BUNDLE_INTERNAL_IP_WHITELIST', '172.17.0.1'),
    ],
    'system' => [
        'call_center_py_host' => env('CALL_CENTER_PY_HOST', 'http://127.0.0.1:5002'),
    ],
];
