<?php

namespace app\bundles\game\response\visitor;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'IndexMenuItemResponse')]
class IndexMenuItemResponse
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer', example: 1)]
    private int $id;

    #[OA\Property(property: 'parent_id', description: '父级ID', type: 'integer', example: 0)]
    private int $parent_id;

    #[OA\Property(property: 'icon', description: '菜单图标', type: 'string', example: '')]
    private string $icon;

    #[OA\Property(property: 'name', description: '菜单名称', type: 'string', example: '系统管理')]
    private string $name;

    #[OA\Property(property: 'path', description: '菜单URL', type: 'string', example: '/systemManagement')]
    private string $path;

    public function setId(int $value): void
    {
        $this->id = $value;
    }

    public function setParentId(int $value): void
    {
        $this->parent_id = $value;
    }

    public function setIcon(string $value): void
    {
        $this->icon = $value;
    }

    public function setName(string $value): void
    {
        $this->name = $value;
    }

    public function setPath(string $value): void
    {
        $this->path = $value;
    }
}