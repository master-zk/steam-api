<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallTraceRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallTraceService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallTraceRepository
    {
        return CallTraceRepository::getInstance();
    }
}
