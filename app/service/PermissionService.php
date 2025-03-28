<?php

declare(strict_types=1);

namespace app\service;

use app\repository\PermissionRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class PermissionService extends CommonService implements ServiceInterface
{
    public function getRepository(): PermissionRepository
    {
        return PermissionRepository::getInstance();
    }
}
