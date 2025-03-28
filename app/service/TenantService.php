<?php

declare(strict_types=1);

namespace app\service;

use app\repository\TenantRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class TenantService extends CommonService implements ServiceInterface
{
    public function getRepository(): TenantRepository
    {
        return TenantRepository::getInstance();
    }
}
