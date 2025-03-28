<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallUserWorkbenchStatusStatRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallUserWorkbenchStatusStatService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallUserWorkbenchStatusStatRepository
    {
        return CallUserWorkbenchStatusStatRepository::getInstance();
    }
}
