<?php

declare(strict_types=1);

namespace app\service;

use app\repository\RegionRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class RegionService extends CommonService implements ServiceInterface
{
    public function getRepository(): RegionRepository
    {
        return RegionRepository::getInstance();
    }
}
