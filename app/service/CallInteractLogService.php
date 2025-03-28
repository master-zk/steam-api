<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallInteractLogRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallInteractLogService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallInteractLogRepository
    {
        return CallInteractLogRepository::getInstance();
    }
}
