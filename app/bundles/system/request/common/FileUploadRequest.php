<?php

declare(strict_types=1);

namespace app\bundles\system\request\common;

use Flame\Validation\Validator;
use OpenApi\Attributes as OA;

const UPLOAD_FILE_SIZE = 100 * 1024 * 1024; // 100MB

#[OA\Schema(
    schema: 'FileUploadRequest',
    required: [
        'file',
    ],
    properties: [
        new OA\Property(property: 'file', description: '文件', type: 'file', format: 'binary'),
    ]
)]
class FileUploadRequest extends Validator
{
    protected array $rule = [
        'file' => 'require|fileSize:'.UPLOAD_FILE_SIZE,
    ];

    protected array $message = [
        'file.require' => '请上传文件',
    ];
}
