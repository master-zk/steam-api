<?php

declare(strict_types=1);

namespace app\service;

use app\repository\UserLogRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class UserLogService extends CommonService implements ServiceInterface
{
    public function getRepository(): UserLogRepository
    {
        return UserLogRepository::getInstance();
    }
}
