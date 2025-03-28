<?php

declare(strict_types=1);

namespace app\service;

use app\repository\GroupRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class GroupService extends CommonService implements ServiceInterface
{
    public function getRepository(): GroupRepository
    {
        return GroupRepository::getInstance();
    }
}
