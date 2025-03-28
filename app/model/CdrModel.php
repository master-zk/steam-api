<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class CdrModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'cdr';

    /**
     * 主键
     */
    protected $pk = 'guid';

    /**
     * 设置字段
     */
    protected $field = [
        'guid',
        'a_leg_id',
        'b_leg_id',
        'caller',
        'callee',
        'queue',
        'ori_number',
        'start_stamp',
        'join_queue_stamp',
        'answer_stamp',
        'end_stamp',
        'duration',
        'eva_data',
        'eva_digits',
        'direction',
    ];
}
