<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class AliasesModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'aliases';

    /**
     * 设置字段
     */
    protected $field = [
        'sticky',
        'alias',
        'command',
        'hostname',
    ];
}
