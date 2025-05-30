<?php

declare(strict_types=1);

namespace app\bundles\system\response\common;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'FileUploadResponse')]
class FileUploadResponse
{
    use ArrayHelper;

    #[OA\Property(property: 'url', description: '附件URL地址', type: 'string')]
    private string $url;

    #[OA\Property(property: 'name', description: '原始文件名', type: 'string')]
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
