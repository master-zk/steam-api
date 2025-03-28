<?php

declare(strict_types=1);

namespace app\bundles\system\service;

class PhoneLocationService
{
    private static ?self $instance = null;

    private array $config;

    public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->config = config('phone_location');
    }
}
