<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CdrTableAbEntity')]
class CdrTableAbEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'guid', description: '', type: 'integer')]
    private int $guid;

    #[OA\Property(property: 'uuid', description: '', type: 'string')]
    private string $uuid;

    #[OA\Property(property: 'call_uuid', description: '', type: 'string')]
    private string $call_uuid;

    #[OA\Property(property: 'caller_id_name', description: '', type: 'string')]
    private string $caller_id_name;

    #[OA\Property(property: 'caller_id_number', description: '', type: 'string')]
    private string $caller_id_number;

    #[OA\Property(property: 'destination_number', description: '', type: 'string')]
    private string $destination_number;

    #[OA\Property(property: 'start_stamp', description: '', type: 'string')]
    private string $start_stamp;

    #[OA\Property(property: 'answer_stamp', description: '', type: 'string')]
    private string $answer_stamp;

    #[OA\Property(property: 'end_stamp', description: '', type: 'string')]
    private string $end_stamp;

    #[OA\Property(property: 'uduration', description: '', type: 'string')]
    private string $uduration;

    #[OA\Property(property: 'billsec', description: '', type: 'string')]
    private string $billsec;

    #[OA\Property(property: 'hangup_cause', description: '', type: 'string')]
    private string $hangup_cause;

    #[OA\Property(property: 'sip_network_ip', description: '', type: 'string')]
    private string $sip_network_ip;

    #[OA\Property(property: 'depart_guid', description: '', type: 'integer')]
    private int $depart_guid;

    #[OA\Property(property: 'remark', description: '', type: 'string')]
    private string $remark;

    #[OA\Property(property: 'sip_call_id', description: '', type: 'string')]
    private string $sip_call_id;

    public function getGuid(): int
    {
        return $this->guid;
    }

    public function setGuid(int $guid): void
    {
        $this->guid = $guid;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getCallUuid(): string
    {
        return $this->call_uuid;
    }

    public function setCallUuid(string $call_uuid): void
    {
        $this->call_uuid = $call_uuid;
    }

    public function getCallerIdName(): string
    {
        return $this->caller_id_name;
    }

    public function setCallerIdName(string $caller_id_name): void
    {
        $this->caller_id_name = $caller_id_name;
    }

    public function getCallerIdNumber(): string
    {
        return $this->caller_id_number;
    }

    public function setCallerIdNumber(string $caller_id_number): void
    {
        $this->caller_id_number = $caller_id_number;
    }

    public function getDestinationNumber(): string
    {
        return $this->destination_number;
    }

    public function setDestinationNumber(string $destination_number): void
    {
        $this->destination_number = $destination_number;
    }

    public function getStartStamp(): string
    {
        return $this->start_stamp;
    }

    public function setStartStamp(string $start_stamp): void
    {
        $this->start_stamp = $start_stamp;
    }

    public function getAnswerStamp(): string
    {
        return $this->answer_stamp;
    }

    public function setAnswerStamp(string $answer_stamp): void
    {
        $this->answer_stamp = $answer_stamp;
    }

    public function getEndStamp(): string
    {
        return $this->end_stamp;
    }

    public function setEndStamp(string $end_stamp): void
    {
        $this->end_stamp = $end_stamp;
    }

    public function getUduration(): string
    {
        return $this->uduration;
    }

    public function setUduration(string $uduration): void
    {
        $this->uduration = $uduration;
    }

    public function getBillsec(): string
    {
        return $this->billsec;
    }

    public function setBillsec(string $billsec): void
    {
        $this->billsec = $billsec;
    }

    public function getHangupCause(): string
    {
        return $this->hangup_cause;
    }

    public function setHangupCause(string $hangup_cause): void
    {
        $this->hangup_cause = $hangup_cause;
    }

    public function getSipNetworkIp(): string
    {
        return $this->sip_network_ip;
    }

    public function setSipNetworkIp(string $sip_network_ip): void
    {
        $this->sip_network_ip = $sip_network_ip;
    }

    public function getDepartGuid(): int
    {
        return $this->depart_guid;
    }

    public function setDepartGuid(int $depart_guid): void
    {
        $this->depart_guid = $depart_guid;
    }

    public function getRemark(): string
    {
        return $this->remark;
    }

    public function setRemark(string $remark): void
    {
        $this->remark = $remark;
    }

    public function getSipCallId(): string
    {
        return $this->sip_call_id;
    }

    public function setSipCallId(string $sip_call_id): void
    {
        $this->sip_call_id = $sip_call_id;
    }
}
