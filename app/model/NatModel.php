<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class NatModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'nat';

    /**
     * 设置字段
     */
    protected $field = [
        'sticky',
        'port',
        'proto',
        'hostname',
    ];
}
