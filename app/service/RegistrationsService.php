<?php

declare(strict_types=1);

namespace app\service;

use app\repository\RegistrationsRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class RegistrationsService extends CommonService implements ServiceInterface
{
    public function getRepository(): RegistrationsRepository
    {
        return RegistrationsRepository::getInstance();
    }
}
