<?php

namespace app\bundles\game\request\visitor;

use Flame\Validation\Validator;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'GameVisitorGameQueryRequest',
    required: [],
    properties: [
        new OA\Property(property: 'category_ids', description: '分类ID', type: 'array', items: new OA\Items(type: 'integer', example: 1)),
    ]
)]
class GameVisitorGameQueryRequest extends Validator
{
    protected array $rule = [
        'keyword' => 'max:30',
        'category_ids' => 'numberArray',
    ];

    protected array $field = [
        'category_ids' => '分类',
    ];

    public function numberArray($value, $rule, $data)
    {
        if (empty($value)) {
            return true;
        }

        if (! is_array($value)) {
            return false;
        }

        foreach ($value as $item) {
            if (! is_int($item)) {
                return false;
            }
        }

        return true;
    }
}
