<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallTransferNumberGroupRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallTransferNumberGroupService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallTransferNumberGroupRepository
    {
        return CallTransferNumberGroupRepository::getInstance();
    }
}
