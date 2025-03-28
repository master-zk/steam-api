<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CallInteractLogEntity')]
class CallInteractLogEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: '主键', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'tenant_id', description: '租户ID', type: 'integer')]
    private int $tenant_id;

    #[OA\Property(property: 'user_id', description: '客服Id', type: 'integer')]
    private int $user_id;

    #[OA\Property(property: 'mobile', description: '手机号', type: 'string')]
    private string $mobile;

    #[OA\Property(property: 'content', description: '沟通内容', type: 'string')]
    private string $content;

    #[OA\Property(property: 'call_trace_id', description: '服务ID', type: 'integer')]
    private int $call_trace_id;

    #[OA\Property(property: 'call_trace_status', description: '服务跟进状态（快照字段）: 0=无 1=待跟进 2=跟进中 3=已完结 ', type: 'integer')]
    private int $call_trace_status;

    #[OA\Property(property: 'call_trace_update_time', description: '服务跟进状态更新时间（快照字段）', type: 'string')]
    private string $call_trace_update_time;

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

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): void
    {
        $this->mobile = $mobile;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getCallTraceId(): int
    {
        return $this->call_trace_id;
    }

    public function setCallTraceId(int $call_trace_id): void
    {
        $this->call_trace_id = $call_trace_id;
    }

    public function getCallTraceStatus(): int
    {
        return $this->call_trace_status;
    }

    public function setCallTraceStatus(int $call_trace_status): void
    {
        $this->call_trace_status = $call_trace_status;
    }

    public function getCallTraceUpdateTime(): string
    {
        return $this->call_trace_update_time;
    }

    public function setCallTraceUpdateTime(string $call_trace_update_time): void
    {
        $this->call_trace_update_time = $call_trace_update_time;
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
