<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class RegionModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'region';

    /**
     * 设置字段
     */
    protected $field = [
        'region_id',
        'region_name',
        'parent_id',
        'short_name',
        'level',
        'city_code',
        'zip_code',
        'merger_name',
        'lng',
        'lat',
        'pinyin',
    ];
}
