<?php

declare(strict_types=1);

namespace Flame\Support\Facade;

use Flame\Mail\Mail as MailManager;

/**
 * @mixin MailManager
 */
class Mail extends Facade
{
    protected static function getFacadeClass(): string
    {
        return MailManager::class;
    }
}
