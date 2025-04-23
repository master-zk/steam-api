<?php

namespace app\bundles\game\response\visitor;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes;

class GameVisitorIndexNavigationResponse
{
    use ArrayHelper;

    #[Attributes\Property(property: 'category', description: '分类', type: 'array', )]
    private array $category;

    public function setCategory(array $value): void
    {
        $this->category = $value;
    }
}