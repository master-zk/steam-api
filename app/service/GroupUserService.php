<?php

declare(strict_types=1);

namespace app\service;

use app\repository\GroupUserRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class GroupUserService extends CommonService implements ServiceInterface
{
    public function getRepository(): GroupUserRepository
    {
        return GroupUserRepository::getInstance();
    }
}
