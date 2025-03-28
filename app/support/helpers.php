<?php

declare(strict_types=1);

use app\exception\CustomException;
use Flame\Support\Str;

/**
 * 手机号脱敏
 */
function mobile_mask(string $mobile): string
{
    return Str::mask($mobile, '*', 3, 4);
}

/**
 * 没有权限
 */
function no_auth_exception(): void
{
    throw new CustomException('无权访问', 400);
}

/**
 * 目标不存在
 */
function not_found_exception(): void
{
    throw new CustomException('目标不存在', 400);
}

/**
 * 数组是否有重复数据
 */
function array_have_repeat_item(mixed $items): bool
{
    if (! is_array($items)) {

        return false;
    }

    if (count($items) == 0) {

        return false;
    }

    $newItems = array_flip($items);
    if (count($newItems) != count($items)) {

        return true;
    }

    return false;
}

/**
 * 清空文件夹
 *
 * @param  string  $dir  文件夹路径
 * @param  bool  $removeSelf  是否删除文件夹本身
 * @return bool 是否成功
 */
function clearDirectory(string $dir, bool $removeSelf = false): bool
{
    if (! is_dir($dir)) {
        return false; // 如果不是目录，直接返回
    }

    // 打开目录
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue; // 跳过当前目录和上级目录
        }

        $path = $dir.DIRECTORY_SEPARATOR.$item;

        // 如果是文件，直接删除
        if (is_file($path)) {
            unlink($path);
        }
        // 如果是目录，递归清空
        elseif (is_dir($path)) {
            clearDirectory($path, true); // 递归清空子目录
        }
    }

    // 如果需要删除文件夹本身
    if ($removeSelf) {
        rmdir($dir);
    }

    return true;
}
