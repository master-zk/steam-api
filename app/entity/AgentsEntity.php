<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'AgentsEntity')]
class AgentsEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'name', description: '', type: 'string')]
    private string $name;

    #[OA\Property(property: 'instance_id', description: '', type: 'string')]
    private string $instance_id;

    #[OA\Property(property: 'uuid', description: '', type: 'string')]
    private string $uuid;

    #[OA\Property(property: 'type', description: '', type: 'string')]
    private string $type;

    #[OA\Property(property: 'contact', description: '', type: 'string')]
    private string $contact;

    #[OA\Property(property: 'status', description: '', type: 'string')]
    private string $status;

    #[OA\Property(property: 'state', description: '', type: 'string')]
    private string $state;

    #[OA\Property(property: 'max_no_answer', description: '', type: 'integer')]
    private int $max_no_answer;

    #[OA\Property(property: 'wrap_up_time', description: '', type: 'integer')]
    private int $wrap_up_time;

    #[OA\Property(property: 'reject_delay_time', description: '', type: 'integer')]
    private int $reject_delay_time;

    #[OA\Property(property: 'busy_delay_time', description: '', type: 'integer')]
    private int $busy_delay_time;

    #[OA\Property(property: 'no_answer_delay_time', description: '', type: 'integer')]
    private int $no_answer_delay_time;

    #[OA\Property(property: 'last_bridge_start', description: '', type: 'integer')]
    private int $last_bridge_start;

    #[OA\Property(property: 'last_bridge_end', description: '', type: 'integer')]
    private int $last_bridge_end;

    #[OA\Property(property: 'last_offered_call', description: '', type: 'integer')]
    private int $last_offered_call;

    #[OA\Property(property: 'last_status_change', description: '', type: 'integer')]
    private int $last_status_change;

    #[OA\Property(property: 'no_answer_count', description: '', type: 'integer')]
    private int $no_answer_count;

    #[OA\Property(property: 'calls_answered', description: '', type: 'integer')]
    private int $calls_answered;

    #[OA\Property(property: 'talk_time', description: '', type: 'integer')]
    private int $talk_time;

    #[OA\Property(property: 'ready_time', description: '', type: 'integer')]
    private int $ready_time;

    #[OA\Property(property: 'external_calls_count', description: '', type: 'integer')]
    private int $external_calls_count;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
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

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getContact(): string
    {
        return $this->contact;
    }

    public function setContact(string $contact): void
    {
        $this->contact = $contact;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getMaxNoAnswer(): int
    {
        return $this->max_no_answer;
    }

    public function setMaxNoAnswer(int $max_no_answer): void
    {
        $this->max_no_answer = $max_no_answer;
    }

    public function getWrapUpTime(): int
    {
        return $this->wrap_up_time;
    }

    public function setWrapUpTime(int $wrap_up_time): void
    {
        $this->wrap_up_time = $wrap_up_time;
    }

    public function getRejectDelayTime(): int
    {
        return $this->reject_delay_time;
    }

    public function setRejectDelayTime(int $reject_delay_time): void
    {
        $this->reject_delay_time = $reject_delay_time;
    }

    public function getBusyDelayTime(): int
    {
        return $this->busy_delay_time;
    }

    public function setBusyDelayTime(int $busy_delay_time): void
    {
        $this->busy_delay_time = $busy_delay_time;
    }

    public function getNoAnswerDelayTime(): int
    {
        return $this->no_answer_delay_time;
    }

    public function setNoAnswerDelayTime(int $no_answer_delay_time): void
    {
        $this->no_answer_delay_time = $no_answer_delay_time;
    }

    public function getLastBridgeStart(): int
    {
        return $this->last_bridge_start;
    }

    public function setLastBridgeStart(int $last_bridge_start): void
    {
        $this->last_bridge_start = $last_bridge_start;
    }

    public function getLastBridgeEnd(): int
    {
        return $this->last_bridge_end;
    }

    public function setLastBridgeEnd(int $last_bridge_end): void
    {
        $this->last_bridge_end = $last_bridge_end;
    }

    public function getLastOfferedCall(): int
    {
        return $this->last_offered_call;
    }

    public function setLastOfferedCall(int $last_offered_call): void
    {
        $this->last_offered_call = $last_offered_call;
    }

    public function getLastStatusChange(): int
    {
        return $this->last_status_change;
    }

    public function setLastStatusChange(int $last_status_change): void
    {
        $this->last_status_change = $last_status_change;
    }

    public function getNoAnswerCount(): int
    {
        return $this->no_answer_count;
    }

    public function setNoAnswerCount(int $no_answer_count): void
    {
        $this->no_answer_count = $no_answer_count;
    }

    public function getCallsAnswered(): int
    {
        return $this->calls_answered;
    }

    public function setCallsAnswered(int $calls_answered): void
    {
        $this->calls_answered = $calls_answered;
    }

    public function getTalkTime(): int
    {
        return $this->talk_time;
    }

    public function setTalkTime(int $talk_time): void
    {
        $this->talk_time = $talk_time;
    }

    public function getReadyTime(): int
    {
        return $this->ready_time;
    }

    public function setReadyTime(int $ready_time): void
    {
        $this->ready_time = $ready_time;
    }

    public function getExternalCallsCount(): int
    {
        return $this->external_calls_count;
    }

    public function setExternalCallsCount(int $external_calls_count): void
    {
        $this->external_calls_count = $external_calls_count;
    }
}
