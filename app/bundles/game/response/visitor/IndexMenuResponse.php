<?php

namespace app\bundles\game\response\visitor;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'IndexMenuResponse')]
class IndexMenuResponse
{
    use ArrayHelper;

    #[OA\Property(property: 'menu', description: '菜单', type: 'array', items: new OA\Items(ref: IndexMenuItemResponse::class))]
    private array $menu;

    public function getMenu(): array
    {
        return $this->menu;
    }

    public function setMenu(array $value): void
    {
        $this->menu = $value;
    }
}