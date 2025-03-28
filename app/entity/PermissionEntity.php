<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'PermissionEntity')]
class PermissionEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'module', description: '模块: employee/common/...', type: 'string')]
    private string $module;

    #[OA\Property(property: 'parent_id', description: '父级ID', type: 'integer')]
    private int $parent_id;

    #[OA\Property(property: 'icon', description: '菜单图标', type: 'string')]
    private string $icon;

    #[OA\Property(property: 'name', description: '规则名称', type: 'string')]
    private string $name;

    #[OA\Property(property: 'rule', description: '唯一标识', type: 'string')]
    private string $rule;

    #[OA\Property(property: 'menu', description: '是否为菜单项: 1是 2否', type: 'integer')]
    private int $menu;

    #[OA\Property(property: 'status', description: '状态: 1正常 2禁用', type: 'integer')]
    private int $status;

    #[OA\Property(property: 'is_internal', description: '是否是内部的: 1=是 2=否', type: 'integer')]
    private int $is_internal;

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

    public function getModule(): string
    {
        return $this->module;
    }

    public function setModule(string $module): void
    {
        $this->module = $module;
    }

    public function getParentId(): int
    {
        return $this->parent_id;
    }

    public function setParentId(int $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRule(): string
    {
        return $this->rule;
    }

    public function setRule(string $rule): void
    {
        $this->rule = $rule;
    }

    public function getMenu(): int
    {
        return $this->menu;
    }

    public function setMenu(int $menu): void
    {
        $this->menu = $menu;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getIsInternal(): int
    {
        return $this->is_internal;
    }

    public function setIsInternal(int $is_internal): void
    {
        $this->is_internal = $is_internal;
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
