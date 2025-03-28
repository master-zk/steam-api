<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class RegistrationsModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'registrations';

    /**
     * 设置字段
     */
    protected $field = [
        'reg_user',
        'realm',
        'token',
        'url',
        'expires',
        'network_ip',
        'network_port',
        'network_proto',
        'hostname',
        'metadata',
    ];
}
