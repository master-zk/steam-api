<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;
use think\model\concern\SoftDelete;

class TenantModel extends CommonModel
{
    use SoftDelete;

    /**
     * 设置表
     */
    protected $name = 'tenant';

    /**
     * 是否需要自动写入时间戳 如果设置为字符串 则表示时间字段的类型.
     *
     * @var bool|string
     */
    protected $autoWriteTimestamp = 'datetime';

    /**
     * 创建时间字段 false表示关闭.
     *
     * @var false|string
     */
    protected $createTime = 'created_time';

    /**
     * 更新时间字段 false表示关闭.
     *
     * @var false|string
     */
    protected $updateTime = 'updated_time';

    /**
     * 软删除字段
     */
    protected string $deleteTime = 'deleted_time';

    /**
     * 设置字段
     */
    protected $field = [
        'id',
        'name',
        'description',
        'is_internal',
        'created_time',
        'updated_time',
        'deleted_time',
    ];
}
