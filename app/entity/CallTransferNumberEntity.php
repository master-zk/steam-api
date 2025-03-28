<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CallTransferNumberEntity')]
class CallTransferNumberEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'tenant_id', description: '租户ID', type: 'integer')]
    private int $tenant_id;

    #[OA\Property(property: 'name', description: '名称', type: 'string')]
    private string $name;

    #[OA\Property(property: 'number', description: '号码', type: 'string')]
    private string $number;

    #[OA\Property(property: 'ivr_id', description: 'IvrId', type: 'integer')]
    private int $ivr_id;

    #[OA\Property(property: 'call_in_evaluation_switch', description: '呼入评价播报开关: 1开启 2关闭', type: 'integer')]
    private int $call_in_evaluation_switch;

    #[OA\Property(property: 'call_out_evaluation_switch', description: '呼出评价播报开关: 1开启 2关闭', type: 'integer')]
    private int $call_out_evaluation_switch;

    #[OA\Property(property: 'queue_up_switch', description: '排队管理开关: 1开启 2关闭', type: 'integer')]
    private int $queue_up_switch;

    #[OA\Property(property: 'is_for_police', description: '公安专线: 1是 2否', type: 'integer')]
    private int $is_for_police;

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

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getIvrId(): int
    {
        return $this->ivr_id;
    }

    public function setIvrId(int $ivr_id): void
    {
        $this->ivr_id = $ivr_id;
    }

    public function getCallInEvaluationSwitch(): int
    {
        return $this->call_in_evaluation_switch;
    }

    public function setCallInEvaluationSwitch(int $call_in_evaluation_switch): void
    {
        $this->call_in_evaluation_switch = $call_in_evaluation_switch;
    }

    public function getCallOutEvaluationSwitch(): int
    {
        return $this->call_out_evaluation_switch;
    }

    public function setCallOutEvaluationSwitch(int $call_out_evaluation_switch): void
    {
        $this->call_out_evaluation_switch = $call_out_evaluation_switch;
    }

    public function getQueueUpSwitch(): int
    {
        return $this->queue_up_switch;
    }

    public function setQueueUpSwitch(int $queue_up_switch): void
    {
        $this->queue_up_switch = $queue_up_switch;
    }

    public function getIsForPolice(): int
    {
        return $this->is_for_police;
    }

    public function setIsForPolice(int $is_for_police): void
    {
        $this->is_for_police = $is_for_police;
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
