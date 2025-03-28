<?php

declare(strict_types=1);

namespace app\service;

use app\repository\InterfacesRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class InterfacesService extends CommonService implements ServiceInterface
{
    public function getRepository(): InterfacesRepository
    {
        return InterfacesRepository::getInstance();
    }
}
