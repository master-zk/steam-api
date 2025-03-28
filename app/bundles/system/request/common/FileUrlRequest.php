<?php

declare(strict_types=1);

namespace app\bundles\system\request\common;

use Flame\Validation\Validator;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'FileUrlRequest',
    required: [
        'path',
    ],
    properties: [
        new OA\Property(property: 'path', description: '文本文件oss路径', type: 'string', example: 'call-center/upload/3/eaf330d7ba5a3aedce86c9554aed4ca5.txt'),
    ]
)]
class FileUrlRequest extends Validator
{
    protected array $rule = [
        'path' => 'require|min:1|max:255',
    ];

    protected array $message = [
        'path.require' => '请设置文件路径',
    ];
}
