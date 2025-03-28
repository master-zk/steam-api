<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CommonConfigFieldRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CommonConfigFieldService extends CommonService implements ServiceInterface
{
    public function getRepository(): CommonConfigFieldRepository
    {
        return CommonConfigFieldRepository::getInstance();
    }
}
