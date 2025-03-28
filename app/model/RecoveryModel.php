<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class RecoveryModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'recovery';

    /**
     * 设置字段
     */
    protected $field = [
        'runtime_uuid',
        'technology',
        'profile_name',
        'hostname',
        'uuid',
        'metadata',
    ];
}
