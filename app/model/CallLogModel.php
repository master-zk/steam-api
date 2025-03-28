<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;
use think\model\concern\SoftDelete;

class CallLogModel extends CommonModel
{
    use SoftDelete;

    /**
     * 设置表
     */
    protected $name = 'call_log';

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
        'call_uuid',
        'call_type',
        'caller',
        'callee',
        'customer_number',
        'customer_number_type',
        'customer_number_prefix',
        'call_status',
        'user_id',
        'transfer_number_id',
        'ivr_id',
        'ivr_item_id',
        'ivr_group_id',
        'call_queue',
        'start_stamp',
        'queue_stamp',
        'answer_stamp',
        'end_stamp',
        'end_type',
        'duration',
        'wait_duration',
        'queue_duration',
        'evaluation_level',
        'evaluation_value',
        'audio_file_status',
        'audio_file_name',
        'audio_file_url',
        'audio_file_error_count',
        'audio_file_error_msg',
        'audio_file_last_handle_stamp',
        'created_time',
        'updated_time',
        'deleted_time',
    ];
}
