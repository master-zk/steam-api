<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class CallGroupPondModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'call_group_pond';

    /**
     * 设置字段
     */
    protected $field = [
        'id',
        'tenant_id',
        'group_id',
    ];
}
