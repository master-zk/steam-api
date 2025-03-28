<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'AliasesEntity')]
class AliasesEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'sticky', description: '', type: 'integer')]
    private int $sticky;

    #[OA\Property(property: 'alias', description: '', type: 'string')]
    private string $alias;

    #[OA\Property(property: 'command', description: '', type: 'string')]
    private string $command;

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

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }

    public function getCommand(): string
    {
        return $this->command;
    }

    public function setCommand(string $command): void
    {
        $this->command = $command;
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
