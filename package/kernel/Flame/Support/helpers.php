<?php

declare(strict_types=1);

use Flame\Config\Config;
use Flame\Http\Response;
use Flame\Routing\Route;
use Flame\Support\Carbon;
use Flame\Support\Facade\Cache;
use Flame\Support\Facade\Cookie;
use Flame\Support\Facade\Request;
use Flame\Support\Facade\Session;

/**
 * 标准时间
 */
function now(): Carbon
{
    return Carbon::now();
}

/**
 * 断点打印
 */
//function dd($data): void
//{
//    dump($data);
//    exit;
//}

/**
 * 调试打印
 */
//function dump($data): void
//{
//    echo '<pre>';
//    print_r($data);
//    echo '</pre>';
//}

/**
 * 获取操作系统
 */
function uname(): string
{
    if (strtoupper(mb_substr(PHP_OS, 0, 3)) === 'WIN') {
        return 'WIN';
    }

    return strtoupper(PHP_OS);
}

/**
 * 返回资源url链接
 */
function asset(string $url): string
{
    return Request::root().'/'.ltrim($url, '/');
}

/**
 * Session管理
 */
function session($name = '', $value = '')
{
    if (is_null($name)) {
        // 清除
        Session::clear();
    } elseif ($name === '') {
        return Session::all();
    } elseif (is_null($value)) {
        // 删除
        Session::delete($name);
    } elseif ($value === '') {
        // 判断或获取
        return str_starts_with($name, '?') ? Session::has(substr($name, 1)) : Session::get($name);
    } else {
        // 设置
        Session::set($name, $value);
    }
}

/**
 * 渲染模板输出
 */
function view(string $template = '', $vars = [], $code = 200): Response
{
    return Response::create($template, 'view', $code)->assign($vars);
}

/**
 * 渲染内容输出
 */
function display(string $content, $vars = [], $code = 200): Response
{
    return Response::create($content, 'view', $code)->isContent()->assign($vars);
}

/**
 * 连接路径
 */
function join_paths($basePath, $path = ''): string
{
    return $basePath.($path != '' ? '/'.ltrim($path, '/') : '');
}

/**
 * 根目录
 */
function base_path(string $path = ''): string
{
    return join_paths(ROOT_PATH, $path);
}

/**
 * 应用目录
 */
function app_path(string $path = ''): string
{
    return join_paths(ROOT_PATH.'/app', $path);
}

/**
 * 配置目录
 */
function config_path(string $path = ''): string
{
    return join_paths(ROOT_PATH.'/config', $path);
}

/**
 * 数据库目录
 */
function database_path(string $path = ''): string
{
    return join_paths(ROOT_PATH.'/database', $path);
}

/**
 * WWW目录
 */
function public_path(string $path = ''): string
{
    return join_paths(ROOT_PATH.'/public', $path);
}

/**
 * 资源目录
 */
function resource_path(string $path = ''): string
{
    return join_paths(ROOT_PATH.'/resource', $path);
}

/**
 * 运行时目录
 */
function runtime_path(string $path = ''): string
{
    return join_paths(ROOT_PATH.'/runtime', $path);
}

/**
 * 验证邮箱地址格式
 */
function is_email(string $email): bool
{
    return ! (filter_var($email, FILTER_VALIDATE_EMAIL) === false);
}

/**
 * 验证手机号码格式
 */
function is_mobile(string $mobile): bool
{
    $rule = '/^1[3-9]\d{9}$/';

    return preg_match($rule, $mobile) === 1;
}

/**
 * 页面跳转
 *
 * @param  string  $url  跳转地址
 * @param  int  $code  跳转代码
 */
function redirect(string $url, int $code = 302): void
{
    header('location:'.$url, true, $code);
    exit;
}

/**
 * 字符串命名风格转换
 * type 0 将Java风格转换为C的风格 1 将C风格转换为Java的风格
 *
 * @param  string  $name  字符串
 * @param  int  $type  转换类型
 * @param  bool  $ucFirst  首字母是否大写（驼峰规则）
 */
function parse_name(string $name, int $type = 0, bool $ucFirst = true): string
{
    if ($type) {
        $name = preg_replace_callback('/_([a-zA-Z])/', function ($match) {
            return strtoupper($match[1]);
        }, $name);

        return $ucFirst ? ucfirst($name) : lcfirst($name);
    }

    return strtolower(trim(preg_replace('/[A-Z]/', '_\\0', $name), '_'));
}

/**
 * 缓存管理
 *
 * @param  mixed  $name  缓存名称
 * @param  mixed  $value  缓存值
 * @param  mixed  $options  缓存参数
 */
function cache(?string $name = null, $value = '', $options = null)
{
    if ($value === '') {
        // 获取缓存
        if (str_starts_with($name, '?')) {
            $name = substr($name, 1);

            return Cache::has($name);
        }

        return Cache::get($name);
    } elseif (is_null($value)) {
        // 删除缓存
        return Cache::forget($name);
    }

    // 缓存数据
    if (is_array($options)) {
        $expire = $options['expire'] ?? null; //修复查询缓存无法设置过期时间
    } else {
        $expire = $options;
    }

    return Cache::set($name, $value, $expire);
}

/**
 * 获取设置配置
 *
 * @param  string  $key  配置项
 * @param  mixed  $value  配置值
 */
function config($key = null, $value = null)
{
    if (func_num_args() <= 1) {
        return Config::get($key);
    } else {
        return Config::set($key, $value);
    }
}

/**
 * URL生成
 *
 * @param  string|null  $route  地址
 * @param  array  $params  参数
 * @return string
 */
function url(?string $route = null, array $params = [])
{
    return Route::url($route, $params);
}

/**
 * Cookie管理
 */
function cookie(string $name, $value = '', $option = null)
{
    if (is_null($value)) {
        // 删除
        Cookie::delete($name, $option ?: []);
    } elseif ($value === '') {
        // 获取
        return str_starts_with($name, '?') ? Cookie::has(substr($name, 1)) : Cookie::get($name);
    } else {
        // 设置
        Cookie::set($name, $value, $option);
    }
}

/**
 * 获取下载对象
 *
 * @param  string  $filename  文件
 * @param  string  $name  显示文件名
 * @param  bool  $content  是否为内容
 * @param  int  $expire  有效期（秒）
 */
function download(string $filename, string $name = '', bool $content = false, int $expire = 180): Response
{
    return Response::create($filename, 'file')->name($name)->isContent($content)->expire($expire);
}

/**
 * 以 MIME 值获取文件编码
 */
function file_encoding(string $file): string
{
    $file_info = finfo_open(FILEINFO_MIME_ENCODING);
    $file_encoding = finfo_file($file_info, $file);
    finfo_close($file_info);

    return strtoupper($file_encoding);
}

/**
 * 将文件大小数字转换为人类可读的等价物
 */
function file_size(int|float $bytes, int $precision = 0, int $mode = PHP_ROUND_HALF_UP): string
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    for ($i = 0; ($bytes / 1024) > 0.9 && ($i < count($units) - 1); $i++) {
        $bytes /= 1024;
    }

    return sprintf('%s %s', round($bytes, $precision, $mode), $units[$i]);
}
