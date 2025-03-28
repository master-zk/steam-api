<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class CallsModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'calls';

    /**
     * 设置字段
     */
    protected $field = [
        'call_uuid',
        'call_created',
        'call_created_epoch',
        'caller_uuid',
        'callee_uuid',
        'hostname',
    ];
}
