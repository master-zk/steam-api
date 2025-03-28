<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;
use think\model\concern\SoftDelete;

class CallUserWorkbenchStatusStatModel extends CommonModel
{
    use SoftDelete;

    /**
     * 设置表
     */
    protected $name = 'call_user_workbench_status_stat';

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
        'tenant_id',
        'day',
        'user_id',
        'online',
        'offline',
        'idle',
        'busy',
        'on_hook',
        'first_online_time',
        'first_logout_time',
        'first_idle_time',
        'first_busy_time',
        'first_on_hook_time',
        'last_online_time',
        'last_logout_time',
        'last_idle_time',
        'last_busy_time',
        'last_on_hook_time',
        'last_status',
        'last_status_at',
        'created_time',
        'updated_time',
        'deleted_time',
    ];
}
