<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;

class TasksModel extends CommonModel
{
    /**
     * 设置表
     */
    protected $name = 'tasks';

    /**
     * 设置字段
     */
    protected $field = [
        'task_id',
        'task_desc',
        'task_group',
        'task_runtime',
        'task_sql_manager',
        'hostname',
    ];
}
