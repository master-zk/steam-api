<?php

declare(strict_types=1);

namespace app\service;

use app\repository\ExportTaskLogRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class ExportTaskLogService extends CommonService implements ServiceInterface
{
    public function getRepository(): ExportTaskLogRepository
    {
        return ExportTaskLogRepository::getInstance();
    }
}
