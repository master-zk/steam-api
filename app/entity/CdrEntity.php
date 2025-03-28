<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CdrEntity')]
class CdrEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'guid', description: '', type: 'integer')]
    private int $guid;

    #[OA\Property(property: 'a_leg_id', description: '', type: 'string')]
    private string $a_leg_id;

    #[OA\Property(property: 'b_leg_id', description: '', type: 'string')]
    private string $b_leg_id;

    #[OA\Property(property: 'caller', description: '', type: 'string')]
    private string $caller;

    #[OA\Property(property: 'callee', description: '', type: 'string')]
    private string $callee;

    #[OA\Property(property: 'queue', description: '', type: 'string')]
    private string $queue;

    #[OA\Property(property: 'ori_number', description: '', type: 'string')]
    private string $ori_number;

    #[OA\Property(property: 'start_stamp', description: '', type: 'string')]
    private string $start_stamp;

    #[OA\Property(property: 'join_queue_stamp', description: '', type: 'string')]
    private string $join_queue_stamp;

    #[OA\Property(property: 'answer_stamp', description: '', type: 'string')]
    private string $answer_stamp;

    #[OA\Property(property: 'end_stamp', description: '', type: 'string')]
    private string $end_stamp;

    #[OA\Property(property: 'duration', description: '', type: 'integer')]
    private int $duration;

    #[OA\Property(property: 'eva_data', description: '', type: 'string')]
    private string $eva_data;

    #[OA\Property(property: 'eva_digits', description: '', type: 'string')]
    private string $eva_digits;

    #[OA\Property(property: 'direction', description: '', type: 'string')]
    private string $direction;

    public function getGuid(): int
    {
        return $this->guid;
    }

    public function setGuid(int $guid): void
    {
        $this->guid = $guid;
    }

    public function getALegId(): string
    {
        return $this->a_leg_id;
    }

    public function setALegId(string $a_leg_id): void
    {
        $this->a_leg_id = $a_leg_id;
    }

    public function getBLegId(): string
    {
        return $this->b_leg_id;
    }

    public function setBLegId(string $b_leg_id): void
    {
        $this->b_leg_id = $b_leg_id;
    }

    public function getCaller(): string
    {
        return $this->caller;
    }

    public function setCaller(string $caller): void
    {
        $this->caller = $caller;
    }

    public function getCallee(): string
    {
        return $this->callee;
    }

    public function setCallee(string $callee): void
    {
        $this->callee = $callee;
    }

    public function getQueue(): string
    {
        return $this->queue;
    }

    public function setQueue(string $queue): void
    {
        $this->queue = $queue;
    }

    public function getOriNumber(): string
    {
        return $this->ori_number;
    }

    public function setOriNumber(string $ori_number): void
    {
        $this->ori_number = $ori_number;
    }

    public function getStartStamp(): string
    {
        return $this->start_stamp;
    }

    public function setStartStamp(string $start_stamp): void
    {
        $this->start_stamp = $start_stamp;
    }

    public function getJoinQueueStamp(): string
    {
        return $this->join_queue_stamp;
    }

    public function setJoinQueueStamp(string $join_queue_stamp): void
    {
        $this->join_queue_stamp = $join_queue_stamp;
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

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function getEvaData(): string
    {
        return $this->eva_data;
    }

    public function setEvaData(string $eva_data): void
    {
        $this->eva_data = $eva_data;
    }

    public function getEvaDigits(): string
    {
        return $this->eva_digits;
    }

    public function setEvaDigits(string $eva_digits): void
    {
        $this->eva_digits = $eva_digits;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }
}
