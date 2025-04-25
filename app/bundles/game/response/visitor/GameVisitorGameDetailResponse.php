<?php

namespace app\bundles\game\response\visitor;

use app\response\common\ChartOptionResponse;
use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'GameVisitorGameDetailResponse')]
class GameVisitorGameDetailResponse
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: '游戏ID', type: 'integer')]
    private int $id;
    #[OA\Property(property: 'title', description: '游戏标题', type: 'string')]
    private string $title;
    #[OA\Property(property: 'short_description', description: '简短描述', type: 'string')]
    private string $short_description;
    #[OA\Property(property: 'description', description: '描述', type: 'string')]
    private string $description;
    #[OA\Property(property: 'coming_soon', description: '发布状态: 1=未发布 2=已发布', type: '1')]
    private int $coming_soon;
    #[OA\Property(property: 'release_date', description: '发布日期（未发布时无）', type: "string", example: '2017-09-15')]
    private string $release_date;
    #[OA\Property(property: 'is_free', description: '是否免费： 1=是 2=否', type: 'integer')]
    private int $is_free;
    #[OA\Property(property: 'age_rating', description: '年龄限制（如 PEGI 18+）', type: 'integer')]
    private int $age_rating;
    #[OA\Property(property: 'website_url', description: '游戏官网URL', type: 'string')]
    private string $website_url;
    #[OA\Property(property: 'os_windows', description: '是否支持windows：0=未知 1=是 2=否', type: 'integer')]
    private int $os_windows;
    #[OA\Property(property: 'os_mac', description: '是否支持mac：0=未知 1=是 2=否', type: 'integer')]
    private int $os_mac;
    #[OA\Property(property: 'os_linux', description: '是否支持linux：0=未知 1=是 2=否', type: 'integer')]
    private int $os_linux;
    #[OA\Property(property: 'review_positive', description: '评测：好评', type: 'integer', example: 57565)]
    private int $review_positive;
    #[OA\Property(property: 'review_negative', description: '评测：差评', type: 'integer', example: 3551)]
    private int $review_negative;
    #[OA\Property(property: 'chart', description: '历史评分', type: 'array', items: new OA\Items(ref: ChartOptionResponse::class))]
    private array $chart;

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