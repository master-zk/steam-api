<?php

namespace app\bundles\game\response\visitor;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'GameCommonListBriefItemResponse')]
class GameCommonListBriefItemResponse
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: '游戏ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'title', description: '游戏标题', type: 'string')]
    private string $title;

    #[OA\Property(property: 'short_description', description: '简短描述', type: 'string')]
    private string $short_description;

    public function setId(mixed $value): void
    {
        $this->id = $value;
    }

    public function setUrl(mixed $value): void
    {
        $this->title = $value;
    }

    public function setName(mixed $value): void
    {
        $this->short_description = $value;
    }
}