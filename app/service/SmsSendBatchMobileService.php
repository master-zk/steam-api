<?php

declare(strict_types=1);

namespace app\service;

use app\repository\SmsSendBatchMobileRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class SmsSendBatchMobileService extends CommonService implements ServiceInterface
{
    public function getRepository(): SmsSendBatchMobileRepository
    {
        return SmsSendBatchMobileRepository::getInstance();
    }
}
