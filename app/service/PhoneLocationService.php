<?php

declare(strict_types=1);

namespace app\service;

use app\repository\PhoneLocationRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class PhoneLocationService extends CommonService implements ServiceInterface
{
    public function getRepository(): PhoneLocationRepository
    {
        return PhoneLocationRepository::getInstance();
    }
}
