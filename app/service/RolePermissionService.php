<?php

declare(strict_types=1);

namespace app\service;

use app\repository\RolePermissionRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class RolePermissionService extends CommonService implements ServiceInterface
{
    public function getRepository(): RolePermissionRepository
    {
        return RolePermissionRepository::getInstance();
    }
}
