<?php

namespace app\scheduler;

use Flame\Console\Contracts\ScheduleTaskInterface;
use Flame\Support\Facade\Log;

class HelloTask implements ScheduleTaskInterface
{
    public function cron(): ?string
    {
        // 每分钟执行一次
        return '0 * * * * *';
    }

    public function handle(): void
    {
        Log::info(__METHOD__);
    }
}
