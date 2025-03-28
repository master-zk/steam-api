<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'TasksEntity')]
class TasksEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'task_id', description: '', type: 'integer')]
    private int $task_id;

    #[OA\Property(property: 'task_desc', description: '', type: 'string')]
    private string $task_desc;

    #[OA\Property(property: 'task_group', description: '', type: 'string')]
    private string $task_group;

    #[OA\Property(property: 'task_runtime', description: '', type: 'integer')]
    private int $task_runtime;

    #[OA\Property(property: 'task_sql_manager', description: '', type: 'integer')]
    private int $task_sql_manager;

    #[OA\Property(property: 'hostname', description: '', type: 'string')]
    private string $hostname;

    public function getTaskId(): int
    {
        return $this->task_id;
    }

    public function setTaskId(int $task_id): void
    {
        $this->task_id = $task_id;
    }

    public function getTaskDesc(): string
    {
        return $this->task_desc;
    }

    public function setTaskDesc(string $task_desc): void
    {
        $this->task_desc = $task_desc;
    }

    public function getTaskGroup(): string
    {
        return $this->task_group;
    }

    public function setTaskGroup(string $task_group): void
    {
        $this->task_group = $task_group;
    }

    public function getTaskRuntime(): int
    {
        return $this->task_runtime;
    }

    public function setTaskRuntime(int $task_runtime): void
    {
        $this->task_runtime = $task_runtime;
    }

    public function getTaskSqlManager(): int
    {
        return $this->task_sql_manager;
    }

    public function setTaskSqlManager(int $task_sql_manager): void
    {
        $this->task_sql_manager = $task_sql_manager;
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
