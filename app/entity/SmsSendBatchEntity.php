<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'SmsSendBatchEntity')]
class SmsSendBatchEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'tenant_id', description: '租户ID', type: 'integer')]
    private int $tenant_id;

    #[OA\Property(property: 'send_type', description: '发送类型：1=单发 2=批量 ', type: 'integer')]
    private int $send_type;

    #[OA\Property(property: 'batch_id', description: '发送批次', type: 'string')]
    private string $batch_id;

    #[OA\Property(property: 'template_code', description: '模版code', type: 'string')]
    private string $template_code;

    #[OA\Property(property: 'content', description: '短信内容', type: 'string')]
    private string $content;

    #[OA\Property(property: 'status', description: '状态: 1正常 2失败', type: 'integer')]
    private int $status;

    #[OA\Property(property: 'error_desc', description: '失败描述', type: 'string')]
    private string $error_desc;

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

    public function getSendType(): int
    {
        return $this->send_type;
    }

    public function setSendType(int $send_type): void
    {
        $this->send_type = $send_type;
    }

    public function getBatchId(): string
    {
        return $this->batch_id;
    }

    public function setBatchId(string $batch_id): void
    {
        $this->batch_id = $batch_id;
    }

    public function getTemplateCode(): string
    {
        return $this->template_code;
    }

    public function setTemplateCode(string $template_code): void
    {
        $this->template_code = $template_code;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getErrorDesc(): string
    {
        return $this->error_desc;
    }

    public function setErrorDesc(string $error_desc): void
    {
        $this->error_desc = $error_desc;
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
