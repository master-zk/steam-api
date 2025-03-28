<?php

declare(strict_types=1);

namespace Flame\Redis;

use Illuminate\Redis\Connections\Connection;
use Illuminate\Redis\Connections\PhpRedisConnection;
use Illuminate\Redis\RedisManager;

/**
 * @mixin PhpRedisConnection
 */
class Redis
{
    protected static ?RedisManager $instance = null;

    public static function instance(): ?RedisManager
    {
        if (is_null(static::$instance)) {
            $config = config('redis');

            static::$instance = new RedisManager(config('app.name'), 'phpredis', $config);
        }

        return static::$instance;
    }

    public static function connection(string $name = 'default'): Connection
    {
        return static::instance()->connection($name);
    }

    public static function __callStatic(string $name, array $arguments)
    {
        return static::connection()->{$name}(...$arguments);
    }
}
