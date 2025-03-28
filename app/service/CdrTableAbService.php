<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CdrTableAbRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CdrTableAbService extends CommonService implements ServiceInterface
{
    public function getRepository(): CdrTableAbRepository
    {
        return CdrTableAbRepository::getInstance();
    }
}
