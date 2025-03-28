<?php

declare(strict_types=1);

namespace tests\feature;

use Exception;
use tests\TestCase;

class HttpRequestTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_http_feature()
    {
        try {
            $this->get('https://www.fakebaidu.com/');

            $this->assertTrue(true);
        } catch (\Throwable $e) {
            $this->fail($e->getMessage());
        }
    }
}
