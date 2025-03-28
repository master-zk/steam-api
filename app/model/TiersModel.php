<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class TiersModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'tiers';

    /**
     * 设置字段
     */
    protected $field = [
        'queue',
        'agent',
        'state',
        'level',
        'position',
    ];
}
