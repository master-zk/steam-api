<?php

declare(strict_types=1);

namespace Flame\Push\Worker;

use ReflectionClass;
use Workerman\Worker;

class PushWorker
{
    public function __construct()
    {
        $this->workerStart('Websocket', config('push.server'));
    }

    /**
     * Start worker
     */
    private function workerStart($processName, $config): void
    {
        $propertyMap = [
            'count',
            'user',
            'group',
            'reloadable',
            'reusePort',
            'transport',
            'protocol',
        ];

        $worker = new Worker($config['listen'], $config['context'] ?? []);
        $worker->name = $processName;

        foreach ($propertyMap as $property) {
            if (isset($config[$property])) {
                $worker->$property = $config[$property];
            }
        }

        $worker->onWorkerStart = function ($worker) use ($config) {
            if (isset($config['handler'])) {
                if (! class_exists($config['handler'])) {
                    echo "process error: class {$config['handler']} not exists\r\n";

                    return;
                }

                $reflection = new ReflectionClass($config['handler']);
                $instance = $reflection->newInstanceArgs($config['constructor'] ?? []);
                $this->workerBind($worker, $instance);
            }
        };
    }

    /**
     * Bind worker
     */
    private function workerBind($worker, $class): void
    {
        $callbackMap = [
            'onConnect',
            'onMessage',
            'onClose',
            'onError',
            'onBufferFull',
            'onBufferDrain',
            'onWorkerStop',
            'onWebSocketConnect',
            'onWorkerReload',
        ];

        foreach ($callbackMap as $name) {
            if (method_exists($class, $name)) {
                $worker->$name = [$class, $name];
            }
        }

        if (method_exists($class, 'onWorkerStart')) {
            call_user_func([$class, 'onWorkerStart'], $worker);
        }
    }
}
