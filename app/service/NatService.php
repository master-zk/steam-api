<?php

declare(strict_types=1);

namespace app\service;

use app\repository\NatRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class NatService extends CommonService implements ServiceInterface
{
    public function getRepository(): NatRepository
    {
        return NatRepository::getInstance();
    }
}
