<?php

declare(strict_types=1);

namespace app\service;

use app\repository\RoleUserRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class RoleUserService extends CommonService implements ServiceInterface
{
    public function getRepository(): RoleUserRepository
    {
        return RoleUserRepository::getInstance();
    }
}
