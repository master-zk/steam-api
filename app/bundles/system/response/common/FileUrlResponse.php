<?php

declare(strict_types=1);

namespace app\bundles\system\response\common;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'FileUrlResponse')]
class FileUrlResponse
{
    use ArrayHelper;

    #[OA\Property(property: 'url', description: '附件URL地址', type: 'string')]
    private string $url;

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
