<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CdrRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CdrService extends CommonService implements ServiceInterface
{
    public function getRepository(): CdrRepository
    {
        return CdrRepository::getInstance();
    }
}
