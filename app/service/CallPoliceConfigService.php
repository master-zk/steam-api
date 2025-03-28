<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallPoliceConfigRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallPoliceConfigService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallPoliceConfigRepository
    {
        return CallPoliceConfigRepository::getInstance();
    }
}
