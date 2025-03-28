<?php

declare(strict_types=1);

namespace Flame\Log;

class ChannelSet
{
    public function __construct(protected LogManager $log, protected array $channels) {}

    public function __call($method, $arguments)
    {
        foreach ($this->channels as $channel) {
            $this->log->channel($channel)->{$method}(...$arguments);
        }
    }
}
