<?php

declare(strict_types=1);

namespace Flame\Support\Facade;

use Flame\Queue\Manager;

/**
 * @method static instance(string $queueName)
 */
class Queue extends Facade
{
    protected static function getFacadeClass(): string
    {
        return Manager::class;
    }
}
