<?php

declare(strict_types=1);

namespace app\service;

use app\repository\TiersRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class TiersService extends CommonService implements ServiceInterface
{
    public function getRepository(): TiersRepository
    {
        return TiersRepository::getInstance();
    }
}
