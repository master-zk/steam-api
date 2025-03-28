<?php

declare(strict_types=1);

namespace app\enums\common;

/**
 * 状态: 1=启用/成功 2=禁用/失败
 */
enum StatusEnum: int
{
    /**
     * 启用/成功
     */
    case Enabled = 1;

    /**
     * 禁用/失败
     */
    case Disabled = 2;
}
