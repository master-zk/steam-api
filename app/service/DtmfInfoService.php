<?php

declare(strict_types=1);

namespace app\service;

use app\repository\DtmfInfoRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class DtmfInfoService extends CommonService implements ServiceInterface
{
    public function getRepository(): DtmfInfoRepository
    {
        return DtmfInfoRepository::getInstance();
    }
}
