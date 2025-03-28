<?php

declare(strict_types=1);

namespace app\manager\dingTalk\enums;

/**
 * 企业管理员
 */
enum UserAdminEnum: int
{
    /**
     * 是的
     */
    case OK = 1;

    /**
     * 不是
     */
    case NO = 0;
}
