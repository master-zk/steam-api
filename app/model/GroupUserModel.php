<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class GroupUserModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'group_user';

    /**
     * 设置字段
     */
    protected $field = [
        'id',
        'tenant_id',
        'group_id',
        'user_id',
        'sort',
    ];
}
