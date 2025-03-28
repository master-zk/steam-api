<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class CompleteModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'complete';

    /**
     * 设置字段
     */
    protected $field = [
        'sticky',
        'a1',
        'a2',
        'a3',
        'a4',
        'a5',
        'a6',
        'a7',
        'a8',
        'a9',
        'a10',
        'hostname',
    ];
}
