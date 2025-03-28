<?php

declare(strict_types=1);

namespace app\service;

use app\repository\TasksRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class TasksService extends CommonService implements ServiceInterface
{
    public function getRepository(): TasksRepository
    {
        return TasksRepository::getInstance();
    }
}
