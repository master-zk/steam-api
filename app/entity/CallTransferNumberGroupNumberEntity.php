<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CallTransferNumberGroupNumberEntity')]
class CallTransferNumberGroupNumberEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'tenant_id', description: '租户ID', type: 'integer')]
    private int $tenant_id;

    #[OA\Property(property: 'group_id', description: '小组ID', type: 'integer')]
    private int $group_id;

    #[OA\Property(property: 'number_id', description: '400号码ID', type: 'integer')]
    private int $number_id;

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

    public function getGroupId(): int
    {
        return $this->group_id;
    }

    public function setGroupId(int $group_id): void
    {
        $this->group_id = $group_id;
    }

    public function getNumberId(): int
    {
        return $this->number_id;
    }

    public function setNumberId(int $number_id): void
    {
        $this->number_id = $number_id;
    }
}
