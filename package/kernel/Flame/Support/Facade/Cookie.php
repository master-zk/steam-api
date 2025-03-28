<?php

declare(strict_types=1);

namespace Flame\Support\Facade;

use Flame\Cookie\Cookie as BaseCookie;

/**
 * @mixin BaseCookie
 *
 * @method static mixed get(mixed $name = '', string $default = null) 获取cookie
 * @method static bool has(string $name) 是否存在Cookie参数
 * @method static void set(string $name, string $value, mixed $option = null) Cookie 设置
 * @method static void forever(string $name, string $value = '', mixed $option = null) 永久保存Cookie数据
 * @method static void delete(string $name) Cookie删除
 * @method static array getCookie() 获取cookie保存数据
 * @method static void save() 保存Cookie
 */
class Cookie extends Facade
{
    protected static bool $alwaysNewInstance = false;

    protected static function getFacadeClass(): string
    {
        return BaseCookie::class;
    }
}
