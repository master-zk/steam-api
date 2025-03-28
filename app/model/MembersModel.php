<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class MembersModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'members';

    /**
     * 设置字段
     */
    protected $field = [
        'queue',
        'instance_id',
        'uuid',
        'session_uuid',
        'cid_number',
        'cid_name',
        'system_epoch',
        'joined_epoch',
        'rejoined_epoch',
        'bridge_epoch',
        'abandoned_epoch',
        'base_score',
        'skill_score',
        'serving_agent',
        'serving_system',
        'state',
    ];
}
