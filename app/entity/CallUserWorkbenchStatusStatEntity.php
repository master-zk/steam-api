<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CallUserWorkbenchStatusStatEntity')]
class CallUserWorkbenchStatusStatEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'tenant_id', description: '租户ID', type: 'integer')]
    private int $tenant_id;

    #[OA\Property(property: 'day', description: '日期', type: 'string')]
    private string $day;

    #[OA\Property(property: 'user_id', description: '用户ID', type: 'integer')]
    private int $user_id;

    #[OA\Property(property: 'online', description: '在线[示闲+示忙+挂起]时长（秒）', type: 'integer')]
    private int $online;

    #[OA\Property(property: 'offline', description: '离线时长（秒）', type: 'integer')]
    private int $offline;

    #[OA\Property(property: 'idle', description: '示闲时长（秒）', type: 'integer')]
    private int $idle;

    #[OA\Property(property: 'busy', description: '示忙时长（秒）', type: 'integer')]
    private int $busy;

    #[OA\Property(property: 'on_hook', description: '挂起时长（秒）', type: 'integer')]
    private int $on_hook;

    #[OA\Property(property: 'first_online_time', description: '首次在线[示闲+示忙+挂起]时间', type: 'string')]
    private string $first_online_time;

    #[OA\Property(property: 'first_logout_time', description: '首次退出登录时间', type: 'string')]
    private string $first_logout_time;

    #[OA\Property(property: 'first_idle_time', description: '首次示闲时间', type: 'string')]
    private string $first_idle_time;

    #[OA\Property(property: 'first_busy_time', description: '首次示忙时间', type: 'string')]
    private string $first_busy_time;

    #[OA\Property(property: 'first_on_hook_time', description: '首次挂起时间', type: 'string')]
    private string $first_on_hook_time;

    #[OA\Property(property: 'last_online_time', description: '最后在线[示闲+示忙+挂起]时间', type: 'string')]
    private string $last_online_time;

    #[OA\Property(property: 'last_logout_time', description: '最后退出登录时间', type: 'string')]
    private string $last_logout_time;

    #[OA\Property(property: 'last_idle_time', description: '最后示闲时间', type: 'string')]
    private string $last_idle_time;

    #[OA\Property(property: 'last_busy_time', description: '最后示忙时间', type: 'string')]
    private string $last_busy_time;

    #[OA\Property(property: 'last_on_hook_time', description: '最后挂起时间', type: 'string')]
    private string $last_on_hook_time;

    #[OA\Property(property: 'last_status', description: '上次报状态：2=离线 3=示闲 4=示忙 5=挂起', type: 'integer')]
    private int $last_status;

    #[OA\Property(property: 'last_status_at', description: '上次上报时间（秒）', type: 'integer')]
    private int $last_status_at;

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

    public function getDay(): string
    {
        return $this->day;
    }

    public function setDay(string $day): void
    {
        $this->day = $day;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getOnline(): int
    {
        return $this->online;
    }

    public function setOnline(int $online): void
    {
        $this->online = $online;
    }

    public function getOffline(): int
    {
        return $this->offline;
    }

    public function setOffline(int $offline): void
    {
        $this->offline = $offline;
    }

    public function getIdle(): int
    {
        return $this->idle;
    }

    public function setIdle(int $idle): void
    {
        $this->idle = $idle;
    }

    public function getBusy(): int
    {
        return $this->busy;
    }

    public function setBusy(int $busy): void
    {
        $this->busy = $busy;
    }

    public function getOnHook(): int
    {
        return $this->on_hook;
    }

    public function setOnHook(int $on_hook): void
    {
        $this->on_hook = $on_hook;
    }

    public function getFirstOnlineTime(): string
    {
        return $this->first_online_time;
    }

    public function setFirstOnlineTime(string $first_online_time): void
    {
        $this->first_online_time = $first_online_time;
    }

    public function getFirstLogoutTime(): string
    {
        return $this->first_logout_time;
    }

    public function setFirstLogoutTime(string $first_logout_time): void
    {
        $this->first_logout_time = $first_logout_time;
    }

    public function getFirstIdleTime(): string
    {
        return $this->first_idle_time;
    }

    public function setFirstIdleTime(string $first_idle_time): void
    {
        $this->first_idle_time = $first_idle_time;
    }

    public function getFirstBusyTime(): string
    {
        return $this->first_busy_time;
    }

    public function setFirstBusyTime(string $first_busy_time): void
    {
        $this->first_busy_time = $first_busy_time;
    }

    public function getFirstOnHookTime(): string
    {
        return $this->first_on_hook_time;
    }

    public function setFirstOnHookTime(string $first_on_hook_time): void
    {
        $this->first_on_hook_time = $first_on_hook_time;
    }

    public function getLastOnlineTime(): string
    {
        return $this->last_online_time;
    }

    public function setLastOnlineTime(string $last_online_time): void
    {
        $this->last_online_time = $last_online_time;
    }

    public function getLastLogoutTime(): string
    {
        return $this->last_logout_time;
    }

    public function setLastLogoutTime(string $last_logout_time): void
    {
        $this->last_logout_time = $last_logout_time;
    }

    public function getLastIdleTime(): string
    {
        return $this->last_idle_time;
    }

    public function setLastIdleTime(string $last_idle_time): void
    {
        $this->last_idle_time = $last_idle_time;
    }

    public function getLastBusyTime(): string
    {
        return $this->last_busy_time;
    }

    public function setLastBusyTime(string $last_busy_time): void
    {
        $this->last_busy_time = $last_busy_time;
    }

    public function getLastOnHookTime(): string
    {
        return $this->last_on_hook_time;
    }

    public function setLastOnHookTime(string $last_on_hook_time): void
    {
        $this->last_on_hook_time = $last_on_hook_time;
    }

    public function getLastStatus(): int
    {
        return $this->last_status;
    }

    public function setLastStatus(int $last_status): void
    {
        $this->last_status = $last_status;
    }

    public function getLastStatusAt(): int
    {
        return $this->last_status_at;
    }

    public function setLastStatusAt(int $last_status_at): void
    {
        $this->last_status_at = $last_status_at;
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
