<?php

namespace app\bundles\game\response\common;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes;

class GameCommonListBriefItemResponse
{
    use ArrayHelper;

    #[Attributes\Property(property: 'title', description: '游戏标题', type: 'string')]
    private string $title;

    #[Attributes\Property(property: 'short_description', description: '简短描述', type: 'string')]
    private string $short_description;

    public function setUrl(mixed $value): void
    {
        $this->title = $value;
    }

    public function setName(mixed $value): void
    {
        $this->short_description = $value;
    }
}