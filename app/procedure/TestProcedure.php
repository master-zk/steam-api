<?php

declare(strict_types=1);

namespace app\procedure;

use Flame\JsonRpc\JsonRpcServer;
use Flame\JsonRpc\Procedure;

class TestProcedure extends JsonRpcServer implements Procedure
{
    public function create(array $params): array
    {
        return [];
    }
}
