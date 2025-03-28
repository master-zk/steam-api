<?php

declare(strict_types=1);

namespace Flame\Console\Worker;

use Flame\Console\Contracts\ScheduleTaskInterface;
use Flame\Support\Arr;
use Flame\Support\Facade\Log;
use ReflectionClass;
use Throwable;
use Workerman\Crontab\Crontab;
use Workerman\Worker;

class ScheduleWorker
{
    //    public function __construct()
    //    {
    //        $tasks = $this->loadTasks();
    //        $worker = new Worker();
    //        $worker->name = 'Schedule';
    //        $worker->onWorkerStart = function () use ($tasks) {
    //            foreach ($tasks as $task) {
    //                echo '['.$task['cronRule'].']'.$task['worker'].' loaded.'.PHP_EOL;
    //                $worker = new $task['worker']();
    //                new Crontab($task['cronRule'], [$worker, 'handle']);
    //            }
    //        };
    //
    //        return 0;
    //    }
    //
    public function __construct()
    {
        $tasks = $this->loadTasks();
        foreach ($tasks as $k => $task) {
            $indexWorker = new Worker;
            $indexWorker->name = 'Schedule'.$k;
            $indexWorker->onWorkerStart = function () use ($task) {
                echo '['.$task['cronRule'].']'.$task['worker'].' loaded.'.PHP_EOL;
                $workerJob = new $task['worker'];
                new Crontab($task['cronRule'], [$workerJob, 'handle']);
            };
        }

        return 0;
    }

    /**
     * 获取全部任务
     */
    private function loadTasks(): array
    {
        $tasks = [];

        $files = array_merge(
            glob(app_path('scheduler/*.php')),
            glob(app_path('bundles/*/scheduler/*.php'))
        );

        foreach ($files as $file) {
            $file = str_replace('\\', '/', $file);
            if (str_contains($file, 'bundles')) {
                preg_match('#(app/bundles/\w+/scheduler/\w+)\.php#', $file, $matches);
            } else {
                preg_match('#(app/scheduler/\w+)\.php#', $file, $matches);
            }
            if (isset($matches[1])) {
                $scheduler = '\\'.str_replace('/', '\\', $matches[1]);
                $cronRule = $this->getTaskRule($scheduler);
                $tasks[] = ['cronRule' => $cronRule, 'worker' => $scheduler];
            }
        }

        return $tasks;
    }

    /**
     * 获取任务时间
     */
    private function getTaskRule(string $scheduler): string
    {
        $cronRule = '';

        try {
            $obj = new $scheduler;
            $cronRule = call_user_func([$obj, 'cron']);

            if (is_null($cronRule)) {
                $reflectionClass = new ReflectionClass($scheduler);
                $reflectionMethod = $reflectionClass->getMethod('handle');
                $attributes = $reflectionMethod->getAttributes();

                foreach ($attributes as $attribute) {
                    if ($attribute->getName().'::class' instanceof ScheduleTaskInterface) {
                        $cronRule = Arr::first($attribute->getArguments());
                    }
                }
            }

            return $cronRule;
        } catch (Throwable $e) {
            Log::error($e);

            return $cronRule;
        }
    }
}
