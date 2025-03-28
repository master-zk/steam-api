<?php

declare(strict_types=1);

namespace app\service;

use app\repository\DetailedCallsRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class DetailedCallsService extends CommonService implements ServiceInterface
{
    public function getRepository(): DetailedCallsRepository
    {
        return DetailedCallsRepository::getInstance();
    }
}
