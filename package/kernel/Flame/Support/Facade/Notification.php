<?php

declare(strict_types=1);

namespace Flame\Support\Facade;

use Flame\Notifications\ChannelManager;

/**
 * @method static void send($notifiables, mixed $notification)
 * @method static void sendNow($notifiables, mixed $notification, array|null $channels = null)
 * @method static mixed channel(string|null $name = null)
 * @method static string getDefaultDriver()
 * @method static string deliversVia()
 * @method static void deliverVia(string $channel)
 * @method static mixed driver(string|null $driver = null)
 * @method static array getDrivers()
 * @method static ChannelManager forgetDrivers()
 *
 * @see ChannelManager
 */
class Notification extends Facade
{
    protected static function getFacadeClass(): string
    {
        return ChannelManager::class;
    }
}
