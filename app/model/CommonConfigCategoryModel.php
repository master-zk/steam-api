<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class CommonConfigCategoryModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'common_config_category';

    /**
     * 设置字段
     */
    protected $field = [
        'id',
        'name',
        'label',
        'desc',
    ];
}
