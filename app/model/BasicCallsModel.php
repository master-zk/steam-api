<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class BasicCallsModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'basic_calls';

    /**
     * 设置字段
     */
    protected $field = [
        'uuid',
        'direction',
        'created',
        'created_epoch',
        'name',
        'state',
        'cid_name',
        'cid_num',
        'ip_addr',
        'dest',
        'presence_id',
        'presence_data',
        'accountcode',
        'callstate',
        'callee_name',
        'callee_num',
        'callee_direction',
        'call_uuid',
        'hostname',
        'sent_callee_name',
        'sent_callee_num',
        'b_uuid',
        'b_direction',
        'b_created',
        'b_created_epoch',
        'b_name',
        'b_state',
        'b_cid_name',
        'b_cid_num',
        'b_ip_addr',
        'b_dest',
        'b_presence_id',
        'b_presence_data',
        'b_accountcode',
        'b_callstate',
        'b_callee_name',
        'b_callee_num',
        'b_callee_direction',
        'b_sent_callee_name',
        'b_sent_callee_num',
        'call_created_epoch',
    ];
}
