<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CompleteRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CompleteService extends CommonService implements ServiceInterface
{
    public function getRepository(): CompleteRepository
    {
        return CompleteRepository::getInstance();
    }
}
