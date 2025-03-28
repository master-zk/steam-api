<?php

declare(strict_types=1);

namespace app\notification;

use Flame\Support\Facade\Notification;
use tests\TestCase;

class SignupNotificationTest extends TestCase
{
    public function test_handle()
    {
        $notifiable = new \stdClass;
        $notifiable->email = 'wanganlin@xhchuxing.com';
        $message = 'email message content';
        Notification::send($notifiable, new SignupNotification($message));

        $this->assertTrue(true);
    }
}
