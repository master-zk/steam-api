<?php

declare(strict_types=1);

namespace Flame\Support\Facade;

use Flame\Log\Channel;
use Flame\Log\ChannelSet;
use Flame\Log\LogManager;

/**
 * @mixin LogManager
 *
 * @method static string|null getDefaultDriver() 默认驱动
 * @method static mixed getConfig(null|string $name = null, mixed $default = null) 获取日志配置
 * @method static array getChannelConfig(string $channel, null $name = null, null $default = null) 获取渠道配置
 * @method static Channel|ChannelSet channel(string|array $name = null) driver() 的别名
 * @method static mixed createDriver(string $name)
 * @method static LogManager clear(string|array $channel = '*') 清空日志信息
 * @method static LogManager close(string|array $channel = '*') 关闭本次请求日志写入
 * @method static array getLog(string $channel = null) 获取日志信息
 * @method static bool save() 保存日志信息
 * @method static LogManager record(mixed $msg, string $type = 'info', array $context = [], bool $lazy = true) 记录日志信息
 * @method static LogManager write(mixed $msg, string $type = 'info', array $context = []) 实时写入日志信息
 * @method static void log(string $level, mixed $message, array $context = []) 记录日志信息
 * @method static void emergency(mixed $message, array $context = []) 记录emergency信息
 * @method static void alert(mixed $message, array $context = []) 记录警报信息
 * @method static void critical(mixed $message, array $context = []) 记录紧急情况
 * @method static void error(mixed $message, array $context = []) 记录错误信息
 * @method static void warning(mixed $message, array $context = []) 记录warning信息
 * @method static void notice(mixed $message, array $context = []) 记录notice信息
 * @method static void info(mixed $message, array $context = []) 记录一般信息
 * @method static void debug(mixed $message, array $context = []) 记录调试信息
 * @method static void sql(mixed $message, array $context = []) 记录sql信息
 * @method static mixed __call($method, $parameters)
 */
class Log extends Facade
{
    protected static function getFacadeClass(): string
    {
        return LogManager::class;
    }
}
