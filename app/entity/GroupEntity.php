<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'GroupEntity')]
class GroupEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'tenant_id', description: '租户ID', type: 'integer')]
    private int $tenant_id;

    #[OA\Property(property: 'name', description: '小组名称', type: 'string')]
    private string $name;

    #[OA\Property(property: 'description', description: '小组描述', type: 'string')]
    private string $description;

    #[OA\Property(property: 'pid', description: '父级ID', type: 'integer')]
    private int $pid;

    #[OA\Property(property: 'level', description: '层级: 1,2,3', type: 'integer')]
    private int $level;

    #[OA\Property(property: 'sort', description: '排序', type: 'integer')]
    private int $sort;

    #[OA\Property(property: 'is_for_vip', description: '是否是Vip专属: 1是 2否', type: 'integer')]
    private int $is_for_vip;

    #[OA\Property(property: 'creator_id', description: '创建人ID', type: 'integer')]
    private int $creator_id;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getSort(): int
    {
        return $this->sort;
    }

    public function setSort(int $sort): void
    {
        $this->sort = $sort;
    }

    public function getIsForVip(): int
    {
        return $this->is_for_vip;
    }

    public function setIsForVip(int $is_for_vip): void
    {
        $this->is_for_vip = $is_for_vip;
    }

    public function getCreatorId(): int
    {
        return $this->creator_id;
    }

    public function setCreatorId(int $creator_id): void
    {
        $this->creator_id = $creator_id;
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
