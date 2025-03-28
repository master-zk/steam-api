<?php

declare(strict_types=1);

namespace app\enums\common;

/**
 * 是否
 */
enum IsEnum: int
{
    /**
     * 是
     */
    case Yes = 1;

    /**
     * 否
     */
    case Not = 2;
}
