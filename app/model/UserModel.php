<?php

declare(strict_types=1);

namespace app\model;

use app\foundation\model\CommonModel;
use think\model\concern\SoftDelete;

class UserModel extends CommonModel
{
    use SoftDelete;

    /**
     * 设置表
     */
    protected $name = 'user';

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
        'id',
        'tenant_id',
        'user_code',
        'name',
        'avatar',
        'mobile',
        'nickname',
        'on_hook_status',
        'status',
        'last_login_type',
        'last_login_token',
        'last_login_token_ext',
        'last_login_at',
        'last_login_ip',
        'creator_id',
        'editor_id',
        'created_time',
        'updated_time',
        'deleted_time',
    ];
}
