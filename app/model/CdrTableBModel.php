<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class CdrTableBModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'cdr_table_b';

    /**
     * 设置字段
     */
    protected $field = [
        'uuid',
        'call_uuid',
        'caller_id_name',
        'caller_id_number',
        'destination_number',
        'start_stamp',
        'answer_stamp',
        'end_stamp',
        'uduration',
        'billsec',
        'hangup_cause',
        'sip_network_ip',
        'depart_guid',
        'sip_call_id',
    ];
}
