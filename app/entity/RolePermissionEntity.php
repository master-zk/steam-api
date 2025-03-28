<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'RolePermissionEntity')]
class RolePermissionEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'role_id', description: '角色ID', type: 'integer')]
    private int $role_id;

    #[OA\Property(property: 'permission_id', description: '权限ID', type: 'integer')]
    private int $permission_id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getRoleId(): int
    {
        return $this->role_id;
    }

    public function setRoleId(int $role_id): void
    {
        $this->role_id = $role_id;
    }

    public function getPermissionId(): int
    {
        return $this->permission_id;
    }

    public function setPermissionId(int $permission_id): void
    {
        $this->permission_id = $permission_id;
    }
}
