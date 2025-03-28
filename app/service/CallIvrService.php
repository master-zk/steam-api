<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallIvrRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallIvrService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallIvrRepository
    {
        return CallIvrRepository::getInstance();
    }
}
