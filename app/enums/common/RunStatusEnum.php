<?php

namespace app\enums\common;

/**
 * 执行状态: 1=成功 2=待执行 3=执行中 4=失败
 */
enum RunStatusEnum: int
{
    /**
     * 成功
     */
    case SUCCESS = 1;

    /**
     * 待执行
     */
    case WAITING = 2;

    /**
     * 执行中
     */
    case RUNNING = 3;

    /**
     * 失败
     */
    case FAIL = 4;
}
