<?php

declare(strict_types=1);

namespace app\enums\common;

/**
 * 开关: 1=开启 2=关闭
 */
enum SwitchEnum: int
{
    /**
     * 开启
     */
    case Enabled = 1;

    /**
     * 关闭
     */
    case Closed = 2;
}
