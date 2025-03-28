<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallLogRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallLogService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallLogRepository
    {
        return CallLogRepository::getInstance();
    }
}
