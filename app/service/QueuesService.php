<?php

declare(strict_types=1);

namespace app\service;

use app\repository\QueuesRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class QueuesService extends CommonService implements ServiceInterface
{
    public function getRepository(): QueuesRepository
    {
        return QueuesRepository::getInstance();
    }
}
