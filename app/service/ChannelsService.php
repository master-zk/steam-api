<?php

declare(strict_types=1);

namespace app\service;

use app\repository\ChannelsRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class ChannelsService extends CommonService implements ServiceInterface
{
    public function getRepository(): ChannelsRepository
    {
        return ChannelsRepository::getInstance();
    }
}
