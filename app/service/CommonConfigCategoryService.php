<?php

declare(strict_types=1);

namespace app\service;

use app\repository\CommonConfigCategoryRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class CommonConfigCategoryService extends CommonService implements ServiceInterface
{
    public function getRepository(): CommonConfigCategoryRepository
    {
        return CommonConfigCategoryRepository::getInstance();
    }
}
