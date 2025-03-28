<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CallIvrItemRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CallIvrItemService extends CommonService implements ServiceInterface
{
    public function getRepository(): CallIvrItemRepository
    {
        return CallIvrItemRepository::getInstance();
    }
}
