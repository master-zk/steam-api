<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class CallLogStatModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'call_log_stat';

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
        'call_type',
        'time_type',
        'time_alias',
        'begin_time',
        'end_time',
        'relation_type',
        'relation_id',
        'call_num',
        'call_answer_num',
        'call_queue_num',
        'call_queue_abandon_num',
        'call_answer_duration',
        'call_wait_duration',
        'call_queue_duration',
        'call_answer_duration_avg',
        'call_wait_duration_avg',
        'call_queue_duration_avg',
        'call_answer_rate',
        'call_is_evaluation_num',
        'call_is_evaluation_rate',
        'call_evaluation_num',
        'call_evaluation_rate',
        'call_evaluation_satisfied_num',
        'call_evaluation_satisfied_rate',
        'created_time',
        'updated_time',
    ];
}
