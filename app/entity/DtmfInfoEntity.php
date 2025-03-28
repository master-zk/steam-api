<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'DtmfInfoEntity')]
class DtmfInfoEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'call_uuid', description: '', type: 'string')]
    private string $call_uuid;

    #[OA\Property(property: 'caller_destination_number', description: '', type: 'string')]
    private string $caller_destination_number;

    #[OA\Property(property: 'caller_id_number', description: '', type: 'string')]
    private string $caller_id_number;

    #[OA\Property(property: 'ivr_menu', description: '', type: 'string')]
    private string $ivr_menu;

    #[OA\Property(property: 'evaluate_ivr', description: '', type: 'string')]
    private string $evaluate_ivr;

    #[OA\Property(property: 'evaluate_digit', description: '', type: 'string')]
    private string $evaluate_digit;

    #[OA\Property(property: 'call_center_queue', description: '', type: 'string')]
    private string $call_center_queue;

    #[OA\Property(property: 'queue_joined_epoch', description: '', type: 'string')]
    private string $queue_joined_epoch;

    #[OA\Property(property: 'created_time', description: '', type: 'string')]
    private string $created_time;

    #[OA\Property(property: 'updated_time', description: '', type: 'string')]
    private string $updated_time;

    #[OA\Property(property: 'deleted_time', description: '', type: 'string')]
    private string $deleted_time;

    #[OA\Property(property: 'queue_digit', description: '', type: 'string')]
    private string $queue_digit;

    public function getCallUuid(): string
    {
        return $this->call_uuid;
    }

    public function setCallUuid(string $call_uuid): void
    {
        $this->call_uuid = $call_uuid;
    }

    public function getCallerDestinationNumber(): string
    {
        return $this->caller_destination_number;
    }

    public function setCallerDestinationNumber(string $caller_destination_number): void
    {
        $this->caller_destination_number = $caller_destination_number;
    }

    public function getCallerIdNumber(): string
    {
        return $this->caller_id_number;
    }

    public function setCallerIdNumber(string $caller_id_number): void
    {
        $this->caller_id_number = $caller_id_number;
    }

    public function getIvrMenu(): string
    {
        return $this->ivr_menu;
    }

    public function setIvrMenu(string $ivr_menu): void
    {
        $this->ivr_menu = $ivr_menu;
    }

    public function getEvaluateIvr(): string
    {
        return $this->evaluate_ivr;
    }

    public function setEvaluateIvr(string $evaluate_ivr): void
    {
        $this->evaluate_ivr = $evaluate_ivr;
    }

    public function getEvaluateDigit(): string
    {
        return $this->evaluate_digit;
    }

    public function setEvaluateDigit(string $evaluate_digit): void
    {
        $this->evaluate_digit = $evaluate_digit;
    }

    public function getCallCenterQueue(): string
    {
        return $this->call_center_queue;
    }

    public function setCallCenterQueue(string $call_center_queue): void
    {
        $this->call_center_queue = $call_center_queue;
    }

    public function getQueueJoinedEpoch(): string
    {
        return $this->queue_joined_epoch;
    }

    public function setQueueJoinedEpoch(string $queue_joined_epoch): void
    {
        $this->queue_joined_epoch = $queue_joined_epoch;
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

    public function getQueueDigit(): string
    {
        return $this->queue_digit;
    }

    public function setQueueDigit(string $queue_digit): void
    {
        $this->queue_digit = $queue_digit;
    }
}
