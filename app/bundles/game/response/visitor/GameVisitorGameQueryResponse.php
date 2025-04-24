<?php

declare(strict_types=1);

namespace app\bundles\game\response\visitor;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'GameVisitorGameQueryResponse')]
class GameVisitorGameQueryResponse
{
    use ArrayHelper;

    #[OA\Property(property: 'total', description: '总数据条数', type: 'integer', example: 1)]
    private int $total;

    #[OA\Property(property: 'per_page', description: '页长', type: 'integer', example: 1)]
    private int $per_page;

    #[OA\Property(property: 'current_page', description: '当前页', type: 'integer', example: 1)]
    private int $current_page;

    #[OA\Property(property: 'last_page', description: '最后一页', type: 'integer', example: 1)]
    private int $last_page;

    #[OA\Property(property: 'data', description: '分页数据', type: 'array', items: new OA\Items(ref: GameCommonListBriefItemResponse::class))]
    private array $data;

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $value): void
    {
        $this->total = $value;
    }

    public function getPerPage(): int
    {
        return $this->per_page;
    }

    public function setPerPage(int $value): void
    {
        $this->per_page = $value;
    }

    public function getCurrentPage(): int
    {
        return $this->current_page;
    }

    public function setCurrentPage(int $value): void
    {
        $this->current_page = $value;
    }

    public function getLastPage(): int
    {
        return $this->last_page;
    }

    public function setLastPage(int $value): void
    {
        $this->last_page = $value;
    }

    public function getListData(): array
    {
        return $this->data;
    }

    public function setListData(array $value): void
    {
        $this->data = $value;
    }
}
