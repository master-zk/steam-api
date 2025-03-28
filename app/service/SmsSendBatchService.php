<?php

declare(strict_types=1);

namespace app\service;

use app\repository\SmsSendBatchRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class SmsSendBatchService extends CommonService implements ServiceInterface
{
    public function getRepository(): SmsSendBatchRepository
    {
        return SmsSendBatchRepository::getInstance();
    }
}
