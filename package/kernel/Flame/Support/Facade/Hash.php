<?php

declare(strict_types=1);

namespace Flame\Support\Facade;

use Flame\Hashing\AbstractHasher;
use Flame\Hashing\BcryptHasher;
use Flame\Hashing\HashManager;

/**
 * @method static BcryptHasher createBcryptDriver()
 * @method static array info(string $hashedValue)
 * @method static string make(string $value, array $options = [])
 * @method static bool check(string $value, string $hashedValue, array $options = [])
 * @method static bool needsRehash(string $hashedValue, array $options = [])
 * @method static bool isHashed(string $value)
 * @method static string getDefaultDriver()
 * @method static mixed driver(string|null $driver = null)
 * @method static HashManager forgetDriver()
 *
 * @see AbstractHasher
 * @see HashManager
 */
class Hash extends Facade
{
    protected static function getFacadeClass(): string
    {
        return HashManager::class;
    }
}
