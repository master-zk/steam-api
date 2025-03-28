<?php

declare(strict_types=1);

namespace app\service;

use app\repository\RoleRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class RoleService extends CommonService implements ServiceInterface
{
    public function getRepository(): RoleRepository
    {
        return RoleRepository::getInstance();
    }
}
