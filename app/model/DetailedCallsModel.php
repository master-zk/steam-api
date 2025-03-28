<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class DetailedCallsModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'detailed_calls';

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
        'application',
        'application_data',
        'dialplan',
        'context',
        'read_codec',
        'read_rate',
        'read_bit_rate',
        'write_codec',
        'write_rate',
        'write_bit_rate',
        'secure',
        'hostname',
        'presence_id',
        'presence_data',
        'accountcode',
        'callstate',
        'callee_name',
        'callee_num',
        'callee_direction',
        'call_uuid',
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
        'b_application',
        'b_application_data',
        'b_dialplan',
        'b_context',
        'b_read_codec',
        'b_read_rate',
        'b_read_bit_rate',
        'b_write_codec',
        'b_write_rate',
        'b_write_bit_rate',
        'b_secure',
        'b_hostname',
        'b_presence_id',
        'b_presence_data',
        'b_accountcode',
        'b_callstate',
        'b_callee_name',
        'b_callee_num',
        'b_callee_direction',
        'b_call_uuid',
        'b_sent_callee_name',
        'b_sent_callee_num',
        'call_created_epoch',
    ];
}
