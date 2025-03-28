<?php

declare(strict_types=1);

namespace app\manager\dingTalk\enums;

/**
 * 企业高管
 */
enum UserSeniorEnum: int
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
