<?php

namespace app\bundles\game\request\visitor;

use Flame\Validation\Validator;
use OpenApi\Attributes;


#[Attributes\Schema(
    schema: 'GameVisitorIndexIndexRequest',
    required: [],
    properties: [
        new Attributes\Property(property: 'type', description: '推荐类型： ""=综合,hot=最热,score=评分最高,cn_hot=国内流行,cn_score=国内评分最高', type: 'integer', example: ''),
    ]
)]
class GameVisitorIndexIndexRequest extends Validator
{
    protected array $rule = [
        'type' => 'in:hot,score,cn_hot,cn_score',
    ];

    protected array $field = [
        'type' => '推荐类型',
    ];

    protected array $message = [
        'type.*' => '请选择推荐类型',
    ];

}