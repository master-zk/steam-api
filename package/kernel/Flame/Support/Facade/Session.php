<?php

declare(strict_types=1);

namespace Flame\Support\Facade;

use Flame\Session\SessionManager;
use Flame\Session\Store;

/**
 * @mixin Store
 */
class Session extends Facade
{
    protected static bool $alwaysNewInstance = false;

    protected static function getFacadeClass(): string
    {
        return SessionManager::class;
    }
}
