<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class AgentsModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'agents';

    /**
     * 设置字段
     */
    protected $field = [
        'name',
        'instance_id',
        'uuid',
        'type',
        'contact',
        'status',
        'state',
        'max_no_answer',
        'wrap_up_time',
        'reject_delay_time',
        'busy_delay_time',
        'no_answer_delay_time',
        'last_bridge_start',
        'last_bridge_end',
        'last_offered_call',
        'last_status_change',
        'no_answer_count',
        'calls_answered',
        'talk_time',
        'ready_time',
        'external_calls_count',
    ];
}
