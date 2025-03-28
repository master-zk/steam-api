<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CdrTableARepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CdrTableAService extends CommonService implements ServiceInterface
{
    public function getRepository(): CdrTableARepository
    {
        return CdrTableARepository::getInstance();
    }
}
