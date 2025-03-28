<?php

declare(strict_types=1);

namespace Flame\Log;

use Flame\Log\Contract\LogHandlerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Stringable;

class Channel implements LoggerInterface
{
    use LoggerTrait;

    /**
     * 日志信息
     */
    protected array $log = [];

    /**
     * 关闭日志
     */
    protected bool $close = false;

    public function __construct(protected string $name, protected LogHandlerInterface $logger, protected array $allow) {}

    /**
     * 关闭通道
     */
    public function close(): void
    {
        $this->clear();
        $this->close = true;
    }

    /**
     * 清空日志
     */
    public function clear(): void
    {
        $this->log = [];
    }

    /**
     * 记录日志信息
     */
    public function record($msg, string $type = 'info', array $context = [])
    {
        if ($this->close || (! empty($this->allow) && ! in_array($type, $this->allow))) {
            return $this;
        }

        if ($msg instanceof Stringable) {
            $msg = $msg->__toString();
        }

        if (is_string($msg) && ! empty($context)) {
            $replace = [];
            foreach ($context as $key => $val) {
                $replace['{'.$key.'}'] = $val;
            }

            $msg = strtr($msg, $replace);
        }

        if (! empty($msg) || $msg === 0) {
            $this->log[$type][] = $msg;
        }

        $this->save();

        return $this;
    }

    /**
     * 实时写入日志信息
     */
    public function write($msg, string $type = 'info', array $context = [])
    {
        return $this->record($msg, $type, $context);
    }

    /**
     * 获取日志信息
     */
    public function getLog(): array
    {
        return $this->log;
    }

    /**
     * 保存日志
     */
    public function save(): bool
    {
        $log = $this->log;

        if ($this->logger->save($log)) {
            $this->clear();

            return true;
        }

        return false;
    }

    /**
     * Logs with an arbitrary level.
     */
    public function log($level, string|Stringable $message, array $context = []): void
    {
        $this->record($message, $level, $context);
    }

    public function __call($method, $parameters)
    {
        $this->log($method, ...$parameters);
    }
}
