<?php

declare(strict_types=1);

namespace Flame\Container\Exception;

use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;
use Throwable;

class FuncNotFoundException extends RuntimeException implements NotFoundExceptionInterface
{
    public function __construct(string $message, protected string $func = '', ?Throwable $previous = null)
    {
        $this->message = $message;

        parent::__construct($message, 0, $previous);
    }

    /**
     * 获取方法名
     */
    public function getFunc(): string
    {
        return $this->func;
    }
}
