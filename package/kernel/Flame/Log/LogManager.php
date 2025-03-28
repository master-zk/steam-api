<?php

declare(strict_types=1);

namespace Flame\Log;

use Flame\Support\Arr;
use Flame\Support\Manager;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Stringable;

class LogManager extends Manager implements LoggerInterface
{
    use LoggerTrait;

    const EMERGENCY = 'emergency';

    const ALERT = 'alert';

    const CRITICAL = 'critical';

    const ERROR = 'error';

    const WARNING = 'warning';

    const NOTICE = 'notice';

    const INFO = 'info';

    const DEBUG = 'debug';

    const SQL = 'sql';

    protected string $namespace = '\\Flame\\Log\\Driver\\';

    /**
     * 默认驱动
     */
    public function getDefaultDriver(): string
    {
        return $this->getConfig('default');
    }

    /**
     * 获取日志配置
     */
    public function getConfig(?string $name = null, $default = null)
    {
        if (! is_null($name)) {
            $config = config('log.'.$name);

            return is_null($config) ? $default : $config;
        }

        return config('log');
    }

    /**
     * 获取渠道配置
     */
    public function getChannelConfig(string $channel, ?string $name = null, $default = null)
    {
        if ($config = $this->getConfig("channels.{$channel}")) {
            return Arr::get($config, $name, $default);
        }

        throw new InvalidArgumentException("Channel [$channel] not found.");
    }

    /**
     * driver()的别名
     */
    public function channel(string|array|null $name = null)
    {
        if (is_array($name)) {
            return new ChannelSet($this, $name);
        }

        return $this->driver($name);
    }

    protected function resolveType(string $name)
    {
        return $this->getChannelConfig($name, 'type', 'file');
    }

    public function createDriver(string $name): Channel
    {
        $driver = parent::createDriver($name);

        $allow = array_merge($this->getConfig('level', []), $this->getChannelConfig($name, 'level', []));

        return new Channel($name, $driver, $allow);
    }

    protected function resolveConfig(string $name)
    {
        return $this->getChannelConfig($name);
    }

    /**
     * 清空日志信息
     */
    public function clear(string|array $channel = '*'): static
    {
        if ($channel == '*') {
            $channel = array_keys($this->drivers);
        }

        $this->channel($channel)->clear();

        return $this;
    }

    /**
     * 关闭本次请求日志写入
     */
    public function close(string|array $channel = '*'): static
    {
        if ($channel == '*') {
            $channel = array_keys($this->drivers);
        }

        $this->channel($channel)->close();

        return $this;
    }

    /**
     * 获取日志信息
     */
    public function getLog(?string $channel = null): array
    {
        return $this->channel($channel)->getLog();
    }

    /**
     * 保存日志信息
     */
    public function save(): bool
    {
        /** @var Channel $channel */
        foreach ($this->drivers as $channel) {
            $channel->save();
        }

        return true;
    }

    /**
     * 记录日志信息
     */
    public function record(string|Stringable $msg, string $type = 'info', array $context = []): static
    {
        $channel = $this->getConfig('type_channel.'.$type);

        $this->channel($channel)->record($msg, $type, $context);

        return $this;
    }

    /**
     * 实时写入日志信息
     */
    public function write(string|Stringable $msg, string $type = 'info', array $context = []): static
    {
        return $this->record($msg, $type, $context);
    }

    /**
     * 记录日志信息
     */
    public function log($level, string|Stringable $message, array $context = []): void
    {
        $this->record($message, $level, $context);
    }

    /**
     * 记录sql信息
     */
    public function sql(string|Stringable $message, array $context = []): void
    {
        $this->log(__FUNCTION__, $message, $context);
    }

    public function __call($method, $parameters)
    {
        $this->log($method, ...$parameters);
    }
}
