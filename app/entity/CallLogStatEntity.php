<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CallLogStatEntity')]
class CallLogStatEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: '主键', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'tenant_id', description: '租户ID', type: 'integer')]
    private int $tenant_id;

    #[OA\Property(property: 'call_type', description: '呼叫类型：1=呼入 2=呼出 3=全部', type: 'integer')]
    private int $call_type;

    #[OA\Property(property: 'time_type', description: '时间类型：1=小时 2=天 3=周 4=月 5=月 6=年', type: 'integer')]
    private int $time_type;

    #[OA\Property(property: 'time_alias', description: '时间段别名', type: 'string')]
    private string $time_alias;

    #[OA\Property(property: 'begin_time', description: '开始时间', type: 'string')]
    private string $begin_time;

    #[OA\Property(property: 'end_time', description: '结束时间', type: 'string')]
    private string $end_time;

    #[OA\Property(property: 'relation_type', description: '关联主题类型：1=租户 2=客服 3=400号码 4=Ivr 5=Ivr节点', type: 'integer')]
    private int $relation_type;

    #[OA\Property(property: 'relation_id', description: '关联主题ID：根据关联主题类型，1=租户ID 2=客服ID 3=400号码ID 4=IvrId 5=Ivr节点ID', type: 'integer')]
    private int $relation_id;

    #[OA\Property(property: 'call_num', description: '通话量', type: 'integer')]
    private int $call_num;

    #[OA\Property(property: 'call_answer_num', description: '接通量', type: 'integer')]
    private int $call_answer_num;

    #[OA\Property(property: 'call_queue_num', description: '排队量 (排队时长大于10秒)', type: 'integer')]
    private int $call_queue_num;

    #[OA\Property(property: 'call_queue_abandon_num', description: '排队放弃量', type: 'integer')]
    private int $call_queue_abandon_num;

    #[OA\Property(property: 'call_answer_duration', description: '通话时长(秒)', type: 'integer')]
    private int $call_answer_duration;

    #[OA\Property(property: 'call_wait_duration', description: '总等待时长(秒)', type: 'integer')]
    private int $call_wait_duration;

    #[OA\Property(property: 'call_queue_duration', description: '总排队时长(秒)', type: 'integer')]
    private int $call_queue_duration;

    #[OA\Property(property: 'call_answer_duration_avg', description: '平均通话时长秒(秒)', type: 'integer')]
    private int $call_answer_duration_avg;

    #[OA\Property(property: 'call_wait_duration_avg', description: '平均等待时长秒(秒)', type: 'integer')]
    private int $call_wait_duration_avg;

    #[OA\Property(property: 'call_queue_duration_avg', description: '平均排队时长秒(秒)', type: 'integer')]
    private int $call_queue_duration_avg;

    #[OA\Property(property: 'call_answer_rate', description: '接通率', type: 'float')]
    private float $call_answer_rate;

    #[OA\Property(property: 'call_is_evaluation_num', description: '邀评量', type: 'integer')]
    private int $call_is_evaluation_num;

    #[OA\Property(property: 'call_is_evaluation_rate', description: '邀评率', type: 'float')]
    private float $call_is_evaluation_rate;

    #[OA\Property(property: 'call_evaluation_num', description: '参评量', type: 'integer')]
    private int $call_evaluation_num;

    #[OA\Property(property: 'call_evaluation_rate', description: '参评率', type: 'float')]
    private float $call_evaluation_rate;

    #[OA\Property(property: 'call_evaluation_satisfied_num', description: '满意量', type: 'integer')]
    private int $call_evaluation_satisfied_num;

    #[OA\Property(property: 'call_evaluation_satisfied_rate', description: '满意率', type: 'float')]
    private float $call_evaluation_satisfied_rate;

    #[OA\Property(property: 'created_time', description: '创建时间', type: 'string')]
    private string $created_time;

    #[OA\Property(property: 'updated_time', description: '更新时间', type: 'string')]
    private string $updated_time;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTenantId(): int
    {
        return $this->tenant_id;
    }

    public function setTenantId(int $tenant_id): void
    {
        $this->tenant_id = $tenant_id;
    }

    public function getCallType(): int
    {
        return $this->call_type;
    }

    public function setCallType(int $call_type): void
    {
        $this->call_type = $call_type;
    }

    public function getTimeType(): int
    {
        return $this->time_type;
    }

    public function setTimeType(int $time_type): void
    {
        $this->time_type = $time_type;
    }

    public function getTimeAlias(): string
    {
        return $this->time_alias;
    }

    public function setTimeAlias(string $time_alias): void
    {
        $this->time_alias = $time_alias;
    }

    public function getBeginTime(): string
    {
        return $this->begin_time;
    }

    public function setBeginTime(string $begin_time): void
    {
        $this->begin_time = $begin_time;
    }

    public function getEndTime(): string
    {
        return $this->end_time;
    }

    public function setEndTime(string $end_time): void
    {
        $this->end_time = $end_time;
    }

    public function getRelationType(): int
    {
        return $this->relation_type;
    }

    public function setRelationType(int $relation_type): void
    {
        $this->relation_type = $relation_type;
    }

    public function getRelationId(): int
    {
        return $this->relation_id;
    }

    public function setRelationId(int $relation_id): void
    {
        $this->relation_id = $relation_id;
    }

    public function getCallNum(): int
    {
        return $this->call_num;
    }

    public function setCallNum(int $call_num): void
    {
        $this->call_num = $call_num;
    }

    public function getCallAnswerNum(): int
    {
        return $this->call_answer_num;
    }

    public function setCallAnswerNum(int $call_answer_num): void
    {
        $this->call_answer_num = $call_answer_num;
    }

    public function getCallQueueNum(): int
    {
        return $this->call_queue_num;
    }

    public function setCallQueueNum(int $call_queue_num): void
    {
        $this->call_queue_num = $call_queue_num;
    }

    public function getCallQueueAbandonNum(): int
    {
        return $this->call_queue_abandon_num;
    }

    public function setCallQueueAbandonNum(int $call_queue_abandon_num): void
    {
        $this->call_queue_abandon_num = $call_queue_abandon_num;
    }

    public function getCallAnswerDuration(): int
    {
        return $this->call_answer_duration;
    }

    public function setCallAnswerDuration(int $call_answer_duration): void
    {
        $this->call_answer_duration = $call_answer_duration;
    }

    public function getCallWaitDuration(): int
    {
        return $this->call_wait_duration;
    }

    public function setCallWaitDuration(int $call_wait_duration): void
    {
        $this->call_wait_duration = $call_wait_duration;
    }

    public function getCallQueueDuration(): int
    {
        return $this->call_queue_duration;
    }

    public function setCallQueueDuration(int $call_queue_duration): void
    {
        $this->call_queue_duration = $call_queue_duration;
    }

    public function getCallAnswerDurationAvg(): int
    {
        return $this->call_answer_duration_avg;
    }

    public function setCallAnswerDurationAvg(int $call_answer_duration_avg): void
    {
        $this->call_answer_duration_avg = $call_answer_duration_avg;
    }

    public function getCallWaitDurationAvg(): int
    {
        return $this->call_wait_duration_avg;
    }

    public function setCallWaitDurationAvg(int $call_wait_duration_avg): void
    {
        $this->call_wait_duration_avg = $call_wait_duration_avg;
    }

    public function getCallQueueDurationAvg(): int
    {
        return $this->call_queue_duration_avg;
    }

    public function setCallQueueDurationAvg(int $call_queue_duration_avg): void
    {
        $this->call_queue_duration_avg = $call_queue_duration_avg;
    }

    public function getCallAnswerRate(): float
    {
        return $this->call_answer_rate;
    }

    public function setCallAnswerRate(float $call_answer_rate): void
    {
        $this->call_answer_rate = $call_answer_rate;
    }

    public function getCallIsEvaluationNum(): int
    {
        return $this->call_is_evaluation_num;
    }

    public function setCallIsEvaluationNum(int $call_is_evaluation_num): void
    {
        $this->call_is_evaluation_num = $call_is_evaluation_num;
    }

    public function getCallIsEvaluationRate(): float
    {
        return $this->call_is_evaluation_rate;
    }

    public function setCallIsEvaluationRate(float $call_is_evaluation_rate): void
    {
        $this->call_is_evaluation_rate = $call_is_evaluation_rate;
    }

    public function getCallEvaluationNum(): int
    {
        return $this->call_evaluation_num;
    }

    public function setCallEvaluationNum(int $call_evaluation_num): void
    {
        $this->call_evaluation_num = $call_evaluation_num;
    }

    public function getCallEvaluationRate(): float
    {
        return $this->call_evaluation_rate;
    }

    public function setCallEvaluationRate(float $call_evaluation_rate): void
    {
        $this->call_evaluation_rate = $call_evaluation_rate;
    }

    public function getCallEvaluationSatisfiedNum(): int
    {
        return $this->call_evaluation_satisfied_num;
    }

    public function setCallEvaluationSatisfiedNum(int $call_evaluation_satisfied_num): void
    {
        $this->call_evaluation_satisfied_num = $call_evaluation_satisfied_num;
    }

    public function getCallEvaluationSatisfiedRate(): float
    {
        return $this->call_evaluation_satisfied_rate;
    }

    public function setCallEvaluationSatisfiedRate(float $call_evaluation_satisfied_rate): void
    {
        $this->call_evaluation_satisfied_rate = $call_evaluation_satisfied_rate;
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
}
