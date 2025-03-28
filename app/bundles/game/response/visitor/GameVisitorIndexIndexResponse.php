<?php

namespace app\bundles\game\response\visitor;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes;

class GameVisitorIndexIndexResponse
{
    use ArrayHelper;

    #[Attributes\Property(property: 'url', description: '附件URL地址', type: 'string')]
    private string $url;

    #[Attributes\Property(property: 'name', description: '原始文件名', type: 'string')]
    private string $name;

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}