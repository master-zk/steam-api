<?php

declare(strict_types=1);

namespace Flame\Container\Exception;

use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;
use Throwable;

class ClassNotFoundException extends RuntimeException implements NotFoundExceptionInterface
{
    public function __construct(string $message, protected string $class = '', ?Throwable $previous = null)
    {
        $this->message = $message;

        parent::__construct($message, 0, $previous);
    }

    /**
     * 获取类名
     */
    public function getClass(): string
    {
        return $this->class;
    }
}
