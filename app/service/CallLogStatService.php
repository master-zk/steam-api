<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallLogStatRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallLogStatService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallLogStatRepository
    {
        return CallLogStatRepository::getInstance();
    }
}
