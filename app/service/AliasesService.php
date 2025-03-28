<?php

declare(strict_types=1);

namespace app\service;

use app\repository\AliasesRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class AliasesService extends CommonService implements ServiceInterface
{
    public function getRepository(): AliasesRepository
    {
        return AliasesRepository::getInstance();
    }
}
