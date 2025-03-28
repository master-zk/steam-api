<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class ExportTaskLogModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'export_task_log';

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
     * 设置字段
     */
    protected $field = [
        'id',
        'tenant_id',
        'user_id',
        'description',
        'export_type',
        'export_args',
        'run_status',
        'oss_file_url',
        'error_count',
        'error_msg',
        'created_time',
        'updated_time',
    ];
}
