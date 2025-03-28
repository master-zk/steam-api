<?php

declare(strict_types=1);

use app\api\common\controller\HealthController;

return [
    '/' => [HealthController::class, 'index'],
];
