<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'UserLogEntity')]
class UserLogEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'tenant_id', description: '租户ID', type: 'integer')]
    private int $tenant_id;

    #[OA\Property(property: 'relation_type', description: '类型', type: 'string')]
    private string $relation_type;

    #[OA\Property(property: 'relation_id', description: '对应类型的主题: 如: 1=用户ID', type: 'integer')]
    private int $relation_id;

    #[OA\Property(property: 'content', description: '操作内容', type: 'string')]
    private string $content;

    #[OA\Property(property: 'operator_id', description: '执行人ID', type: 'integer')]
    private int $operator_id;

    #[OA\Property(property: 'operator_ip', description: '执行人IP', type: 'string')]
    private string $operator_ip;

    #[OA\Property(property: 'operator_time', description: '执行时间', type: 'string')]
    private string $operator_time;

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

    public function getRelationType(): string
    {
        return $this->relation_type;
    }

    public function setRelationType(string $relation_type): void
    {
        $this->relation_type = $relation_type;
    }

    public function getRelationId(): int
    {
        return $this->relation_id;
    }

    public function setRelationId(int $relation_id): void
    {
        $this->relation_id = $relation_id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getOperatorId(): int
    {
        return $this->operator_id;
    }

    public function setOperatorId(int $operator_id): void
    {
        $this->operator_id = $operator_id;
    }

    public function getOperatorIp(): string
    {
        return $this->operator_ip;
    }

    public function setOperatorIp(string $operator_ip): void
    {
        $this->operator_ip = $operator_ip;
    }

    public function getOperatorTime(): string
    {
        return $this->operator_time;
    }

    public function setOperatorTime(string $operator_time): void
    {
        $this->operator_time = $operator_time;
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
