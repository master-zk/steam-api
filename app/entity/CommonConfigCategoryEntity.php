<?php

declare(strict_types=1);

namespace app\entity;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'CommonConfigCategoryEntity')]
class CommonConfigCategoryEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'name', description: '名称', type: 'string')]
    private string $name;

    #[OA\Property(property: 'label', description: '标签', type: 'string')]
    private string $label;

    #[OA\Property(property: 'desc', description: '描述', type: 'string')]
    private string $desc;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function setDesc(string $desc): void
    {
        $this->desc = $desc;
    }
}
