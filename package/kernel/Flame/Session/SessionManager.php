<?php

declare(strict_types=1);

namespace Flame\Session;

use Flame\Support\Arr;
use Flame\Support\Manager;

/**
 * Session管理类
 *
 * @mixin Store
 */
class SessionManager extends Manager
{
    protected string $namespace = '\\Flame\\Session\\Driver\\';

    protected function createDriver(string $name): Store
    {
        $handler = parent::createDriver($name);

        return new Store($this->getConfig('name') ?: 'PHPSESSID', $handler, $this->getConfig('serialize'));
    }

    /**
     * 获取Session配置
     */
    public function getConfig(?string $name = null, $default = null)
    {
        if (! is_null($name)) {
            return config('session.'.$name) ?? $default;
        }

        return config('session');
    }

    protected function resolveConfig(string $name)
    {
        $config = config('session');

        Arr::forget($config, 'type');

        return $config;
    }

    /**
     * 默认驱动
     */
    public function getDefaultDriver(): string
    {
        return config('session.type') ?? 'file';
    }
}
