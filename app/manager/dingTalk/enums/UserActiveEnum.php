<?php

declare(strict_types=1);

namespace app\manager\dingTalk\enums;

/**
 * 用户钉钉状态
 */
enum UserActiveEnum: int
{
    /**
     * 正常
     */
    case OK = 1;

    /**
     * 停用
     */
    case DISABLE = 2;
}
