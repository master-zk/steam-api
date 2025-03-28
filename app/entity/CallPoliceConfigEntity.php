<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CallPoliceConfigEntity')]
class CallPoliceConfigEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'tenant_id', description: '租户ID', type: 'integer')]
    private int $tenant_id;

    #[OA\Property(property: 'call_in_mobile', description: '呼入号码', type: 'string')]
    private string $call_in_mobile;

    #[OA\Property(property: 'transfer_number', description: '分配400号码', type: 'string')]
    private string $transfer_number;

    #[OA\Property(property: 'contacts_username', description: '紧急联系人姓名', type: 'string')]
    private string $contacts_username;

    #[OA\Property(property: 'contacts_mobile', description: '紧急联系人手机号', type: 'string')]
    private string $contacts_mobile;

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

    public function getCallInMobile(): string
    {
        return $this->call_in_mobile;
    }

    public function setCallInMobile(string $call_in_mobile): void
    {
        $this->call_in_mobile = $call_in_mobile;
    }

    public function getTransferNumber(): string
    {
        return $this->transfer_number;
    }

    public function setTransferNumber(string $transfer_number): void
    {
        $this->transfer_number = $transfer_number;
    }

    public function getContactsUsername(): string
    {
        return $this->contacts_username;
    }

    public function setContactsUsername(string $contacts_username): void
    {
        $this->contacts_username = $contacts_username;
    }

    public function getContactsMobile(): string
    {
        return $this->contacts_mobile;
    }

    public function setContactsMobile(string $contacts_mobile): void
    {
        $this->contacts_mobile = $contacts_mobile;
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
