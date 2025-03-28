<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CdrTableBRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CdrTableBService extends CommonService implements ServiceInterface
{
    public function getRepository(): CdrTableBRepository
    {
        return CdrTableBRepository::getInstance();
    }
}
