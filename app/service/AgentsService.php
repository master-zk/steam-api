<?php

declare(strict_types=1);

namespace app\service;

use app\repository\AgentsRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class AgentsService extends CommonService implements ServiceInterface
{
    public function getRepository(): AgentsRepository
    {
        return AgentsRepository::getInstance();
    }
}
