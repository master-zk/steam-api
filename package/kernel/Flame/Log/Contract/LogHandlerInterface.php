<?php

declare(strict_types=1);

namespace Flame\Log\Contract;

interface LogHandlerInterface
{
    /**
     * 日志写入接口
     */
    public function save(array $log): bool;
}
