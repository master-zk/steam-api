<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class InterfacesModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'interfaces';

    /**
     * 设置字段
     */
    protected $field = [
        'type',
        'name',
        'description',
        'ikey',
        'filename',
        'syntax',
        'hostname',
    ];
}
