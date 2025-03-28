<?php

declare(strict_types=1);

namespace Flame\Support\Facade;

/**
 * @method static \Illuminate\Cache\RateLimiter for(string $name, \Closure $callback)
 * @method static \Closure|null limiter(string $name)
 * @method static mixed attempt(string $key, int $maxAttempts, \Closure $callback, int $decaySeconds = 60)
 * @method static bool tooManyAttempts(string $key, int $maxAttempts)
 * @method static int hit(string $key, int $decaySeconds = 60)
 * @method static mixed attempts(string $key)
 * @method static mixed resetAttempts(string $key)
 * @method static int remaining(string $key, int $maxAttempts)
 * @method static int retriesLeft(string $key, int $maxAttempts)
 * @method static void clear(string $key)
 * @method static int availableIn(string $key)
 * @method static string cleanRateLimiterKey(string $key)
 *
 * @see \Illuminate\Cache\RateLimiter
 */
class RateLimiter extends Facade
{
    protected static function getFacadeClass(): string
    {
        return \Flame\Cache\RateLimiter::class;
    }
}
