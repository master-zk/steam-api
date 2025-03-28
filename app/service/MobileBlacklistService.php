<?php

declare(strict_types=1);

namespace app\service;

use app\repository\MobileBlacklistRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class MobileBlacklistService extends CommonService implements ServiceInterface
{
    public function getRepository(): MobileBlacklistRepository
    {
        return MobileBlacklistRepository::getInstance();
    }
}
