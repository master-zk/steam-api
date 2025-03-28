<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CallLogEntity')]
class CallLogEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: '主键', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'tenant_id', description: '租户ID', type: 'integer')]
    private int $tenant_id;

    #[OA\Property(property: 'call_uuid', description: '通话uuid (sip端生成)', type: 'string')]
    private string $call_uuid;

    #[OA\Property(property: 'call_type', description: '呼叫类型：0=未知 1=呼入 2=呼出', type: 'integer')]
    private int $call_type;

    #[OA\Property(property: 'caller', description: '呼叫方号码', type: 'string')]
    private string $caller;

    #[OA\Property(property: 'callee', description: '被呼叫方号码', type: 'string')]
    private string $callee;

    #[OA\Property(property: 'customer_number', description: '客户号码: (呼入时=呼叫方号码, 呼出时=被呼叫方号码)', type: 'string')]
    private string $customer_number;

    #[OA\Property(property: 'customer_number_type', description: '客户号码类型: 1=手机号 2=座机 ', type: 'integer')]
    private int $customer_number_type;

    #[OA\Property(property: 'customer_number_prefix', description: '客户号码区号: 1752124/0371 ', type: 'string')]
    private string $customer_number_prefix;

    #[OA\Property(property: 'call_status', description: '呼叫状态: 0=未知 1=呼入-400接通 2=呼入-已分配队列 3=呼入-已分配客服 4=呼入-客服已接通', type: 'integer')]
    private int $call_status;

    #[OA\Property(property: 'user_id', description: '客服Id', type: 'integer')]
    private int $user_id;

    #[OA\Property(property: 'transfer_number_id', description: '400号码ID call_transfer_number.id', type: 'integer')]
    private int $transfer_number_id;

    #[OA\Property(property: 'ivr_id', description: 'IvrId call_ivr.id', type: 'integer')]
    private int $ivr_id;

    #[OA\Property(property: 'ivr_item_id', description: 'Ivr进线节点ID call_ivr_item.id', type: 'integer')]
    private int $ivr_item_id;

    #[OA\Property(property: 'ivr_group_id', description: 'Ivr最终分组ID', type: 'integer')]
    private int $ivr_group_id;

    #[OA\Property(property: 'call_queue', description: '通话分配队列', type: 'string')]
    private string $call_queue;

    #[OA\Property(property: 'start_stamp', description: '进线时间', type: 'string')]
    private string $start_stamp;

    #[OA\Property(property: 'queue_stamp', description: '分配队列的时间', type: 'string')]
    private string $queue_stamp;

    #[OA\Property(property: 'answer_stamp', description: '通话接起时间', type: 'string')]
    private string $answer_stamp;

    #[OA\Property(property: 'end_stamp', description: '通话结束时间', type: 'string')]
    private string $end_stamp;

    #[OA\Property(property: 'end_type', description: '挂断方: 0=无 1=客服挂断 2=用户挂断', type: 'integer')]
    private int $end_type;

    #[OA\Property(property: 'duration', description: '通话时长(秒) end_stamp - answer_stamp', type: 'integer')]
    private int $duration;

    #[OA\Property(property: 'wait_duration', description: '等待时长(秒) answer_stamp - start_stamp', type: 'integer')]
    private int $wait_duration;

    #[OA\Property(property: 'queue_duration', description: '排队时长(秒) answer_stamp - queue_stamp', type: 'integer')]
    private int $queue_duration;

    #[OA\Property(property: 'evaluation_level', description: '邀评等级： 0=无 1=一级邀评 2=二级邀评', type: 'integer')]
    private int $evaluation_level;

    #[OA\Property(property: 'evaluation_value', description: '评价值: 0=无评价数据 1=满意 2=不满意 3=非常满意', type: 'integer')]
    private int $evaluation_value;

    #[OA\Property(property: 'audio_file_status', description: '语音文件状态：0=无文件 1=上传完成 2=上传中 3=上传失败', type: 'integer')]
    private int $audio_file_status;

    #[OA\Property(property: 'audio_file_name', description: '音频文件名称', type: 'string')]
    private string $audio_file_name;

    #[OA\Property(property: 'audio_file_url', description: '语音文件oss路径', type: 'string')]
    private string $audio_file_url;

    #[OA\Property(property: 'audio_file_error_count', description: '语音文件处理失败次数', type: 'integer')]
    private int $audio_file_error_count;

    #[OA\Property(property: 'audio_file_error_msg', description: '语音文件处理失败原因', type: 'string')]
    private string $audio_file_error_msg;

    #[OA\Property(property: 'audio_file_last_handle_stamp', description: '语音文件上次处理时间', type: 'string')]
    private string $audio_file_last_handle_stamp;

    #[OA\Property(property: 'created_time', description: '创建时间', type: 'string')]
    private string $created_time;

    #[OA\Property(property: 'updated_time', description: '更新时间', type: 'string')]
    private string $updated_time;

    #[OA\Property(property: 'deleted_time', description: '删除时间', type: 'string')]
    private string $deleted_time;

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

    public function getCallUuid(): string
    {
        return $this->call_uuid;
    }

    public function setCallUuid(string $call_uuid): void
    {
        $this->call_uuid = $call_uuid;
    }

    public function getCallType(): int
    {
        return $this->call_type;
    }

    public function setCallType(int $call_type): void
    {
        $this->call_type = $call_type;
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

    public function getCustomerNumber(): string
    {
        return $this->customer_number;
    }

    public function setCustomerNumber(string $customer_number): void
    {
        $this->customer_number = $customer_number;
    }

    public function getCustomerNumberType(): int
    {
        return $this->customer_number_type;
    }

    public function setCustomerNumberType(int $customer_number_type): void
    {
        $this->customer_number_type = $customer_number_type;
    }

    public function getCustomerNumberPrefix(): string
    {
        return $this->customer_number_prefix;
    }

    public function setCustomerNumberPrefix(string $customer_number_prefix): void
    {
        $this->customer_number_prefix = $customer_number_prefix;
    }

    public function getCallStatus(): int
    {
        return $this->call_status;
    }

    public function setCallStatus(int $call_status): void
    {
        $this->call_status = $call_status;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getTransferNumberId(): int
    {
        return $this->transfer_number_id;
    }

    public function setTransferNumberId(int $transfer_number_id): void
    {
        $this->transfer_number_id = $transfer_number_id;
    }

    public function getIvrId(): int
    {
        return $this->ivr_id;
    }

    public function setIvrId(int $ivr_id): void
    {
        $this->ivr_id = $ivr_id;
    }

    public function getIvrItemId(): int
    {
        return $this->ivr_item_id;
    }

    public function setIvrItemId(int $ivr_item_id): void
    {
        $this->ivr_item_id = $ivr_item_id;
    }

    public function getIvrGroupId(): int
    {
        return $this->ivr_group_id;
    }

    public function setIvrGroupId(int $ivr_group_id): void
    {
        $this->ivr_group_id = $ivr_group_id;
    }

    public function getCallQueue(): string
    {
        return $this->call_queue;
    }

    public function setCallQueue(string $call_queue): void
    {
        $this->call_queue = $call_queue;
    }

    public function getStartStamp(): string
    {
        return $this->start_stamp;
    }

    public function setStartStamp(string $start_stamp): void
    {
        $this->start_stamp = $start_stamp;
    }

    public function getQueueStamp(): string
    {
        return $this->queue_stamp;
    }

    public function setQueueStamp(string $queue_stamp): void
    {
        $this->queue_stamp = $queue_stamp;
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

    public function getEndType(): int
    {
        return $this->end_type;
    }

    public function setEndType(int $end_type): void
    {
        $this->end_type = $end_type;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function getWaitDuration(): int
    {
        return $this->wait_duration;
    }

    public function setWaitDuration(int $wait_duration): void
    {
        $this->wait_duration = $wait_duration;
    }

    public function getQueueDuration(): int
    {
        return $this->queue_duration;
    }

    public function setQueueDuration(int $queue_duration): void
    {
        $this->queue_duration = $queue_duration;
    }

    public function getEvaluationLevel(): int
    {
        return $this->evaluation_level;
    }

    public function setEvaluationLevel(int $evaluation_level): void
    {
        $this->evaluation_level = $evaluation_level;
    }

    public function getEvaluationValue(): int
    {
        return $this->evaluation_value;
    }

    public function setEvaluationValue(int $evaluation_value): void
    {
        $this->evaluation_value = $evaluation_value;
    }

    public function getAudioFileStatus(): int
    {
        return $this->audio_file_status;
    }

    public function setAudioFileStatus(int $audio_file_status): void
    {
        $this->audio_file_status = $audio_file_status;
    }

    public function getAudioFileName(): string
    {
        return $this->audio_file_name;
    }

    public function setAudioFileName(string $audio_file_name): void
    {
        $this->audio_file_name = $audio_file_name;
    }

    public function getAudioFileUrl(): string
    {
        return $this->audio_file_url;
    }

    public function setAudioFileUrl(string $audio_file_url): void
    {
        $this->audio_file_url = $audio_file_url;
    }

    public function getAudioFileErrorCount(): int
    {
        return $this->audio_file_error_count;
    }

    public function setAudioFileErrorCount(int $audio_file_error_count): void
    {
        $this->audio_file_error_count = $audio_file_error_count;
    }

    public function getAudioFileErrorMsg(): string
    {
        return $this->audio_file_error_msg;
    }

    public function setAudioFileErrorMsg(string $audio_file_error_msg): void
    {
        $this->audio_file_error_msg = $audio_file_error_msg;
    }

    public function getAudioFileLastHandleStamp(): string
    {
        return $this->audio_file_last_handle_stamp;
    }

    public function setAudioFileLastHandleStamp(string $audio_file_last_handle_stamp): void
    {
        $this->audio_file_last_handle_stamp = $audio_file_last_handle_stamp;
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

    public function getDeletedTime(): string
    {
        return $this->deleted_time;
    }

    public function setDeletedTime(string $deleted_time): void
    {
        $this->deleted_time = $deleted_time;
    }
}
