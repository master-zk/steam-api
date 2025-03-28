<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'ExportTaskLogEntity')]
class ExportTaskLogEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'tenant_id', description: '租户ID', type: 'integer')]
    private int $tenant_id;

    #[OA\Property(property: 'user_id', description: '用户Id', type: 'integer')]
    private int $user_id;

    #[OA\Property(property: 'description', description: '导出描述', type: 'string')]
    private string $description;

    #[OA\Property(property: 'export_type', description: '导出任务类型：HistoryCall...', type: 'string')]
    private string $export_type;

    #[OA\Property(property: 'export_args', description: '导出任务的参数', type: 'string')]
    private string $export_args;

    #[OA\Property(property: 'run_status', description: '执行状态：0=无 1=待执行 2=执行中 3=执行失败 4=执行成功 5=失败重试', type: 'integer')]
    private int $run_status;

    #[OA\Property(property: 'oss_file_url', description: '语音文件oss路径', type: 'string')]
    private string $oss_file_url;

    #[OA\Property(property: 'error_count', description: '处理失败次数', type: 'integer')]
    private int $error_count;

    #[OA\Property(property: 'error_msg', description: '处理失败原因', type: 'string')]
    private string $error_msg;

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

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getExportType(): string
    {
        return $this->export_type;
    }

    public function setExportType(string $export_type): void
    {
        $this->export_type = $export_type;
    }

    public function getExportArgs(): string
    {
        return $this->export_args;
    }

    public function setExportArgs(string $export_args): void
    {
        $this->export_args = $export_args;
    }

    public function getRunStatus(): int
    {
        return $this->run_status;
    }

    public function setRunStatus(int $run_status): void
    {
        $this->run_status = $run_status;
    }

    public function getOssFileUrl(): string
    {
        return $this->oss_file_url;
    }

    public function setOssFileUrl(string $oss_file_url): void
    {
        $this->oss_file_url = $oss_file_url;
    }

    public function getErrorCount(): int
    {
        return $this->error_count;
    }

    public function setErrorCount(int $error_count): void
    {
        $this->error_count = $error_count;
    }

    public function getErrorMsg(): string
    {
        return $this->error_msg;
    }

    public function setErrorMsg(string $error_msg): void
    {
        $this->error_msg = $error_msg;
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
