<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class PhoneLocationModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'phone_location';

    /**
     * 设置字段
     */
    protected $field = [
        'id',
        'pref',
        'phone',
        'province',
        'city',
        'isp',
        'isp_type',
        'post_code',
        'city_code',
        'area_code',
        'create_time',
    ];
}
