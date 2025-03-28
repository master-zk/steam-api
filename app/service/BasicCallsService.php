<?php

declare(strict_types=1);

namespace app\service;

use app\repository\BasicCallsRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class BasicCallsService extends CommonService implements ServiceInterface
{
    public function getRepository(): BasicCallsRepository
    {
        return BasicCallsRepository::getInstance();
    }
}
