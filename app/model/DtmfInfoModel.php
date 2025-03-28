<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;
use think\model\concern\SoftDelete;

class DtmfInfoModel extends CommonModel
{
    use SoftDelete;

    /**
     * 设置表
     */
    protected $name = 'dtmf_info';

    /**
     * 主键
     */
    protected $pk = 'call_uuid';

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
     * 软删除字段
     */
    protected string $deleteTime = 'deleted_time';

    /**
     * 设置字段
     */
    protected $field = [
        'call_uuid',
        'caller_destination_number',
        'caller_id_number',
        'ivr_menu',
        'evaluate_ivr',
        'evaluate_digit',
        'call_center_queue',
        'queue_joined_epoch',
        'created_time',
        'updated_time',
        'deleted_time',
        'queue_digit',
    ];
}
