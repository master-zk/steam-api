<?php

declare(strict_types=1);

namespace app\service;

use app\repository\RecoveryRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class RecoveryService extends CommonService implements ServiceInterface
{
    public function getRepository(): RecoveryRepository
    {
        return RecoveryRepository::getInstance();
    }
}
