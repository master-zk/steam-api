<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'TiersEntity')]
class TiersEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'queue', description: '', type: 'string')]
    private string $queue;

    #[OA\Property(property: 'agent', description: '', type: 'string')]
    private string $agent;

    #[OA\Property(property: 'state', description: '', type: 'string')]
    private string $state;

    #[OA\Property(property: 'level', description: '', type: 'integer')]
    private int $level;

    #[OA\Property(property: 'position', description: '', type: 'integer')]
    private int $position;

    public function getQueue(): string
    {
        return $this->queue;
    }

    public function setQueue(string $queue): void
    {
        $this->queue = $queue;
    }

    public function getAgent(): string
    {
        return $this->agent;
    }

    public function setAgent(string $agent): void
    {
        $this->agent = $agent;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }
}
