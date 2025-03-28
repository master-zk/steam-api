<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallsRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallsService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallsRepository
    {
        return CallsRepository::getInstance();
    }
}
