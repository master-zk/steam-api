<?php

declare(strict_types=1);

namespace app\service;

use app\repository\MembersRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class MembersService extends CommonService implements ServiceInterface
{
    public function getRepository(): MembersRepository
    {
        return MembersRepository::getInstance();
    }
}
