<?php

declare(strict_types=1);

namespace app\service;

use app\repository\MobileVipRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class MobileVipService extends CommonService implements ServiceInterface
{
    public function getRepository(): MobileVipRepository
    {
        return MobileVipRepository::getInstance();
    }
}
