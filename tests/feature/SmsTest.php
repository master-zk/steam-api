<?php

declare(strict_types=1);

namespace tests\feature;

use Flame\Sms\Sms;
use tests\TestCase;

class SmsTest extends TestCase
{
    public function test_send()
    {
        try {
            $sms = new Sms;
            $sms->send('15858589999', 'SMS_CODE', ['code' => 123456]);

            $this->assertTrue(true);
        } catch (\Throwable $e) {
            $this->fail($e->getMessage());
        }
    }
}
