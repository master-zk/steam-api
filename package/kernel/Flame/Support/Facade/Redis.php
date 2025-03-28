<?php

declare(strict_types=1);

namespace Flame\Support\Facade;

use Flame\Redis\Redis as RedisManager;
use Illuminate\Redis\Connections\PhpRedisConnection;

/**
 * @mixin PhpRedisConnection
 */
class Redis extends Facade
{
    protected static function getFacadeClass(): string
    {
        return RedisManager::class;
    }
}
