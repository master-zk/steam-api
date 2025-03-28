<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'UserEntity')]
class UserEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'tenant_id', description: '当前租户ID', type: 'integer')]
    private int $tenant_id;

    #[OA\Property(property: 'user_code', description: '用户code', type: 'string')]
    private string $user_code;

    #[OA\Property(property: 'name', description: '姓名', type: 'string')]
    private string $name;

    #[OA\Property(property: 'avatar', description: '头像', type: 'string')]
    private string $avatar;

    #[OA\Property(property: 'mobile', description: '手机号码', type: 'string')]
    private string $mobile;

    #[OA\Property(property: 'nickname', description: '昵称', type: 'string')]
    private string $nickname;

    #[OA\Property(property: 'on_hook_status', description: '挂机状态: 1自动示闲 2自动挂起', type: 'integer')]
    private int $on_hook_status;

    #[OA\Property(property: 'status', description: '状态: 1正常 2禁用 3挂起', type: 'integer')]
    private int $status;

    #[OA\Property(property: 'last_login_type', description: '最后登录方式: 1=手机验证码登录', type: 'integer')]
    private int $last_login_type;

    #[OA\Property(property: 'last_login_token', description: '最后登录token', type: 'string')]
    private string $last_login_token;

    #[OA\Property(property: 'last_login_token_ext', description: '最后登录token有效期', type: 'string')]
    private string $last_login_token_ext;

    #[OA\Property(property: 'last_login_at', description: '最后登录时间', type: 'string')]
    private string $last_login_at;

    #[OA\Property(property: 'last_login_ip', description: '最后登录IP', type: 'string')]
    private string $last_login_ip;

    #[OA\Property(property: 'creator_id', description: '创建人ID', type: 'integer')]
    private int $creator_id;

    #[OA\Property(property: 'editor_id', description: '编辑人ID', type: 'integer')]
    private int $editor_id;

    #[OA\Property(property: 'created_time', description: '创建时间', type: 'string')]
    private string $created_time;

    #[OA\Property(property: 'updated_time', description: '更新时间', type: 'string')]
    private string $updated_time;

    #[OA\Property(property: 'deleted_time', description: '删除时间', type: 'string')]
    private string $deleted_time;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTenantId(): int
    {
        return $this->tenant_id;
    }

    public function setTenantId(int $tenant_id): void
    {
        $this->tenant_id = $tenant_id;
    }

    public function getUserCode(): string
    {
        return $this->user_code;
    }

    public function setUserCode(string $user_code): void
    {
        $this->user_code = $user_code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): void
    {
        $this->mobile = $mobile;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function getOnHookStatus(): int
    {
        return $this->on_hook_status;
    }

    public function setOnHookStatus(int $on_hook_status): void
    {
        $this->on_hook_status = $on_hook_status;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getLastLoginType(): int
    {
        return $this->last_login_type;
    }

    public function setLastLoginType(int $last_login_type): void
    {
        $this->last_login_type = $last_login_type;
    }

    public function getLastLoginToken(): string
    {
        return $this->last_login_token;
    }

    public function setLastLoginToken(string $last_login_token): void
    {
        $this->last_login_token = $last_login_token;
    }

    public function getLastLoginTokenExt(): string
    {
        return $this->last_login_token_ext;
    }

    public function setLastLoginTokenExt(string $last_login_token_ext): void
    {
        $this->last_login_token_ext = $last_login_token_ext;
    }

    public function getLastLoginAt(): string
    {
        return $this->last_login_at;
    }

    public function setLastLoginAt(string $last_login_at): void
    {
        $this->last_login_at = $last_login_at;
    }

    public function getLastLoginIp(): string
    {
        return $this->last_login_ip;
    }

    public function setLastLoginIp(string $last_login_ip): void
    {
        $this->last_login_ip = $last_login_ip;
    }

    public function getCreatorId(): int
    {
        return $this->creator_id;
    }

    public function setCreatorId(int $creator_id): void
    {
        $this->creator_id = $creator_id;
    }

    public function getEditorId(): int
    {
        return $this->editor_id;
    }

    public function setEditorId(int $editor_id): void
    {
        $this->editor_id = $editor_id;
    }

    public function getCreatedTime(): string
    {
        return $this->created_time;
    }

    public function setCreatedTime(string $created_time): void
    {
        $this->created_time = $created_time;
    }

    public function getUpdatedTime(): string
    {
        return $this->updated_time;
    }

    public function setUpdatedTime(string $updated_time): void
    {
        $this->updated_time = $updated_time;
    }

    public function getDeletedTime(): string
    {
        return $this->deleted_time;
    }

    public function setDeletedTime(string $deleted_time): void
    {
        $this->deleted_time = $deleted_time;
    }
}
