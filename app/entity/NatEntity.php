<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'NatEntity')]
class NatEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'sticky', description: '', type: 'integer')]
    private int $sticky;

    #[OA\Property(property: 'port', description: '', type: 'integer')]
    private int $port;

    #[OA\Property(property: 'proto', description: '', type: 'integer')]
    private int $proto;

    #[OA\Property(property: 'hostname', description: '', type: 'string')]
    private string $hostname;

    public function getSticky(): int
    {
        return $this->sticky;
    }

    public function setSticky(int $sticky): void
    {
        $this->sticky = $sticky;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    public function getProto(): int
    {
        return $this->proto;
    }

    public function setProto(int $proto): void
    {
        $this->proto = $proto;
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
