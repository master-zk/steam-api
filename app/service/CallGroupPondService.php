<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallGroupPondRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallGroupPondService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallGroupPondRepository
    {
        return CallGroupPondRepository::getInstance();
    }
}
