<?php

declare(strict_types=1);

namespace app\service;

use app\repository\UserRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class UserService extends CommonService implements ServiceInterface
{
    public function getRepository(): UserRepository
    {
        return UserRepository::getInstance();
    }
}
