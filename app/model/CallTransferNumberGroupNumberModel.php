<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class CallTransferNumberGroupNumberModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'call_transfer_number_group_number';

    /**
     * 设置字段
     */
    protected $field = [
        'id',
        'tenant_id',
        'group_id',
        'number_id',
    ];
}
