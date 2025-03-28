<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'RecoveryEntity')]
class RecoveryEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'runtime_uuid', description: '', type: 'string')]
    private string $runtime_uuid;

    #[OA\Property(property: 'technology', description: '', type: 'string')]
    private string $technology;

    #[OA\Property(property: 'profile_name', description: '', type: 'string')]
    private string $profile_name;

    #[OA\Property(property: 'hostname', description: '', type: 'string')]
    private string $hostname;

    #[OA\Property(property: 'uuid', description: '', type: 'string')]
    private string $uuid;

    #[OA\Property(property: 'metadata', description: '', type: 'string')]
    private string $metadata;

    public function getRuntimeUuid(): string
    {
        return $this->runtime_uuid;
    }

    public function setRuntimeUuid(string $runtime_uuid): void
    {
        $this->runtime_uuid = $runtime_uuid;
    }

    public function getTechnology(): string
    {
        return $this->technology;
    }

    public function setTechnology(string $technology): void
    {
        $this->technology = $technology;
    }

    public function getProfileName(): string
    {
        return $this->profile_name;
    }

    public function setProfileName(string $profile_name): void
    {
        $this->profile_name = $profile_name;
    }

    public function getHostname(): string
    {
        return $this->hostname;
    }

    public function setHostname(string $hostname): void
    {
        $this->hostname = $hostname;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getMetadata(): string
    {
        return $this->metadata;
    }

    public function setMetadata(string $metadata): void
    {
        $this->metadata = $metadata;
    }
}
