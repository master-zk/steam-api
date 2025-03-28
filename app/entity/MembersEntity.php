<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'MembersEntity')]
class MembersEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'queue', description: '', type: 'string')]
    private string $queue;

    #[OA\Property(property: 'instance_id', description: '', type: 'string')]
    private string $instance_id;

    #[OA\Property(property: 'uuid', description: '', type: 'string')]
    private string $uuid;

    #[OA\Property(property: 'session_uuid', description: '', type: 'string')]
    private string $session_uuid;

    #[OA\Property(property: 'cid_number', description: '', type: 'string')]
    private string $cid_number;

    #[OA\Property(property: 'cid_name', description: '', type: 'string')]
    private string $cid_name;

    #[OA\Property(property: 'system_epoch', description: '', type: 'integer')]
    private int $system_epoch;

    #[OA\Property(property: 'joined_epoch', description: '', type: 'integer')]
    private int $joined_epoch;

    #[OA\Property(property: 'rejoined_epoch', description: '', type: 'integer')]
    private int $rejoined_epoch;

    #[OA\Property(property: 'bridge_epoch', description: '', type: 'integer')]
    private int $bridge_epoch;

    #[OA\Property(property: 'abandoned_epoch', description: '', type: 'integer')]
    private int $abandoned_epoch;

    #[OA\Property(property: 'base_score', description: '', type: 'integer')]
    private int $base_score;

    #[OA\Property(property: 'skill_score', description: '', type: 'integer')]
    private int $skill_score;

    #[OA\Property(property: 'serving_agent', description: '', type: 'string')]
    private string $serving_agent;

    #[OA\Property(property: 'serving_system', description: '', type: 'string')]
    private string $serving_system;

    #[OA\Property(property: 'state', description: '', type: 'string')]
    private string $state;

    public function getQueue(): string
    {
        return $this->queue;
    }

    public function setQueue(string $queue): void
    {
        $this->queue = $queue;
    }

    public function getInstanceId(): string
    {
        return $this->instance_id;
    }

    public function setInstanceId(string $instance_id): void
    {
        $this->instance_id = $instance_id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getSessionUuid(): string
    {
        return $this->session_uuid;
    }

    public function setSessionUuid(string $session_uuid): void
    {
        $this->session_uuid = $session_uuid;
    }

    public function getCidNumber(): string
    {
        return $this->cid_number;
    }

    public function setCidNumber(string $cid_number): void
    {
        $this->cid_number = $cid_number;
    }

    public function getCidName(): string
    {
        return $this->cid_name;
    }

    public function setCidName(string $cid_name): void
    {
        $this->cid_name = $cid_name;
    }

    public function getSystemEpoch(): int
    {
        return $this->system_epoch;
    }

    public function setSystemEpoch(int $system_epoch): void
    {
        $this->system_epoch = $system_epoch;
    }

    public function getJoinedEpoch(): int
    {
        return $this->joined_epoch;
    }

    public function setJoinedEpoch(int $joined_epoch): void
    {
        $this->joined_epoch = $joined_epoch;
    }

    public function getRejoinedEpoch(): int
    {
        return $this->rejoined_epoch;
    }

    public function setRejoinedEpoch(int $rejoined_epoch): void
    {
        $this->rejoined_epoch = $rejoined_epoch;
    }

    public function getBridgeEpoch(): int
    {
        return $this->bridge_epoch;
    }

    public function setBridgeEpoch(int $bridge_epoch): void
    {
        $this->bridge_epoch = $bridge_epoch;
    }

    public function getAbandonedEpoch(): int
    {
        return $this->abandoned_epoch;
    }

    public function setAbandonedEpoch(int $abandoned_epoch): void
    {
        $this->abandoned_epoch = $abandoned_epoch;
    }

    public function getBaseScore(): int
    {
        return $this->base_score;
    }

    public function setBaseScore(int $base_score): void
    {
        $this->base_score = $base_score;
    }

    public function getSkillScore(): int
    {
        return $this->skill_score;
    }

    public function setSkillScore(int $skill_score): void
    {
        $this->skill_score = $skill_score;
    }

    public function getServingAgent(): string
    {
        return $this->serving_agent;
    }

    public function setServingAgent(string $serving_agent): void
    {
        $this->serving_agent = $serving_agent;
    }

    public function getServingSystem(): string
    {
        return $this->serving_system;
    }

    public function setServingSystem(string $serving_system): void
    {
        $this->serving_system = $serving_system;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }
}
