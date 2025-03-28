<?php

declare(strict_types=1);

namespace Flame\Queue;

use Flame\Queue\Contracts\JobInterface;
use Flame\Redis\Redis;
use Flame\Support\Facade\Log;
use RedisException;

class RedisQueue
{
    private string $queueName;

    public function __construct(string $queueName)
    {
        $this->queueName = $queueName;
    }

    /**
     * 推送队列任务
     */
    public function push(JobInterface $job): string
    {
        try {
            return Redis::xadd($this->getKeyName(), '*', [serialize($job)]);
        } catch (RedisException $e) {
            Log::error($e);

            return '';
        }
    }

    /**
     * 出队列
     */
    public function pull(int $count = 10): array
    {
        try {
            $queues = Redis::xrange($this->getKeyName(), '-', '+', $count);
            $jobs = [];
            if (! empty($queues)) {
                foreach ($queues as $id => $job) {
                    $job = unserialize($job[0]);
                    if ($job instanceof JobInterface) {
                        $jobs[$id] = $job;
                    }
                }
            }

            return $jobs;
        } catch (RedisException $e) {
            Log::error($e);

            return [];
        }
    }

    /**
     * 删除消息
     */
    public function remove(array $ids): int
    {
        try {
            return Redis::xdel($this->getKeyName(), $ids);
        } catch (RedisException $e) {
            Log::error($e);

            return 0;
        }
    }

    /**
     * 获取队列任务总数
     */
    public function count(): int
    {
        try {
            return Redis::xlen($this->getKeyName());
        } catch (RedisException $e) {
            Log::error($e);

            return 0;
        }
    }

    /**
     * 返回redis存储的key名
     */
    protected function getKeyName(): string
    {
        $name = empty($this->queueName) ? $this->getDefaultKeyName() : $this->queueName;

        return 'queues:'.$name;
    }

    /**
     * 获取默认的key名
     */
    protected function getDefaultKeyName(): string
    {
        return 'default';
    }
}
