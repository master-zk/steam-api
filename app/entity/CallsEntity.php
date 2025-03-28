<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CallsEntity')]
class CallsEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'call_uuid', description: '', type: 'string')]
    private string $call_uuid;

    #[OA\Property(property: 'call_created', description: '', type: 'string')]
    private string $call_created;

    #[OA\Property(property: 'call_created_epoch', description: '', type: 'integer')]
    private int $call_created_epoch;

    #[OA\Property(property: 'caller_uuid', description: '', type: 'string')]
    private string $caller_uuid;

    #[OA\Property(property: 'callee_uuid', description: '', type: 'string')]
    private string $callee_uuid;

    #[OA\Property(property: 'hostname', description: '', type: 'string')]
    private string $hostname;

    public function getCallUuid(): string
    {
        return $this->call_uuid;
    }

    public function setCallUuid(string $call_uuid): void
    {
        $this->call_uuid = $call_uuid;
    }

    public function getCallCreated(): string
    {
        return $this->call_created;
    }

    public function setCallCreated(string $call_created): void
    {
        $this->call_created = $call_created;
    }

    public function getCallCreatedEpoch(): int
    {
        return $this->call_created_epoch;
    }

    public function setCallCreatedEpoch(int $call_created_epoch): void
    {
        $this->call_created_epoch = $call_created_epoch;
    }

    public function getCallerUuid(): string
    {
        return $this->caller_uuid;
    }

    public function setCallerUuid(string $caller_uuid): void
    {
        $this->caller_uuid = $caller_uuid;
    }

    public function getCalleeUuid(): string
    {
        return $this->callee_uuid;
    }

    public function setCalleeUuid(string $callee_uuid): void
    {
        $this->callee_uuid = $callee_uuid;
    }

    public function getHostname(): string
    {
        return $this->hostname;
    }

    public function setHostname(string $hostname): void
    {
        $this->hostname = $hostname;
    }
}
