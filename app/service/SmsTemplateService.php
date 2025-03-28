<?php

declare(strict_types=1);

namespace app\service;

use app\repository\SmsTemplateRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class SmsTemplateService extends CommonService implements ServiceInterface
{
    public function getRepository(): SmsTemplateRepository
    {
        return SmsTemplateRepository::getInstance();
    }
}
