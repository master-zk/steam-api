<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class RoleUserModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'role_user';

    /**
     * 设置字段
     */
    protected $field = [
        'id',
        'role_id',
        'user_id',
    ];
}
