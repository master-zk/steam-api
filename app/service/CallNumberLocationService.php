<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallNumberLocationRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallNumberLocationService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallNumberLocationRepository
    {
        return CallNumberLocationRepository::getInstance();
    }
}
