<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class ChannelsModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'channels';

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
        'initial_cid_name',
        'initial_cid_num',
        'initial_ip_addr',
        'initial_dest',
        'initial_dialplan',
        'initial_context',
    ];
}
