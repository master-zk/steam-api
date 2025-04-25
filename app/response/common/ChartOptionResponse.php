<?php

declare(strict_types=1);

namespace app\response\common;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'ChartOptionResponse')]
class ChartOptionResponse
{
    use ArrayHelper;

    #[OA\Property(property: 'x', description: '横坐标数据', type: 'string', example: '2025-01-23')]
    private string $x;

    #[OA\Property(property: 'y', description: '纵坐标数据0', type: 'number', example: 1.1)]
    private int $y;

    public function setX(mixed $val): void
    {
        $this->x = $val;
    }

    public function setY(mixed $val): void
    {
        $this->y = $val;
    }
}
