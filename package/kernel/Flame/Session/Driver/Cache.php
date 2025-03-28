<?php

declare(strict_types=1);

namespace Flame\Session\Driver;

use Flame\Session\Contracts\SessionHandlerInterface;
use Flame\Support\Facade\Cache as CacheHandler;
use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

class Cache implements SessionHandlerInterface
{
    protected CacheInterface $handler;

    protected int $expire;

    protected string $prefix;

    public function __construct(array $config = [])
    {
        $this->handler = CacheHandler::store();
        $this->expire = $config['expire'] ?? 1440;
        $this->prefix = $config['prefix'] ?? '';
    }

    /**
     * @throws InvalidArgumentException
     */
    public function read(string $sessionId): string
    {
        return (string) $this->handler->get($this->prefix.$sessionId);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function delete(string $sessionId): bool
    {
        return $this->handler->delete($this->prefix.$sessionId);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function write(string $sessionId, string $data): bool
    {
        return $this->handler->set($this->prefix.$sessionId, $data, $this->expire);
    }
}
