<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallTransferNumberRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallTransferNumberService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallTransferNumberRepository
    {
        return CallTransferNumberRepository::getInstance();
    }
}
