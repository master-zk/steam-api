<?php

declare(strict_types=1);

namespace app\api\common\controller;

use Flame\Http\Response;

class HealthController extends BaseController
{
    public function index(): Response
    {
        return $this->json([
            'status' => 'up',
            'version' => config('app.version'),
        ]);
    }
}
