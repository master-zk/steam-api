<?php

namespace app\bundles\game\controller\visitor;

use app\api\visitor\controller\VisitorBaseController;
use app\bundles\game\services\CategoryService;
use app\response\common\OptionResponse;
use Flame\Http\Response;
use OpenApi\Attributes as OA;

class CategoryController extends VisitorBaseController
{
    #[OA\Get(path: '/api/game/visitor/category/select', summary: '游戏分类', security: [['bearerAuth' => []]], tags: ['分类'])]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(type: "array",  items: new OA\Items(ref: OptionResponse::class)))]
    public function select(): Response
    {
        $category = (new CategoryService())->getSelect();

        return $this->success($category);
    }
}