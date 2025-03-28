<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallTransferNumberGroupNumberRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallTransferNumberGroupNumberService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallTransferNumberGroupNumberRepository
    {
        return CallTransferNumberGroupNumberRepository::getInstance();
    }
}
