<?php

namespace app\bundles\game\controller\visitor;

use app\api\visitor\controller\VisitorBaseController;
use app\api\visitor\services\CategoryService;
use app\bundles\game\request\visitor\GameVisitorIndexIndexRequest;
use app\bundles\game\response\common\GameCommonListBriefItemResponse;
use app\bundles\game\response\visitor\GameVisitorIndexNavigationResponse;
use OpenApi\Attributes as OA;
use Flame\Http\Response;

class IndexController extends VisitorBaseController
{
    #[OA\Get(path: '/api/game/visitor/index/navigation', summary: '首页:默认数据', security: [['bearerAuth' => []]], tags: ['首页导航'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: GameVisitorIndexIndexRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: GameVisitorIndexNavigationResponse::class))]
    public function navigation(): Response
    {
        $category = (new CategoryService())->getList();
        $response = new GameVisitorIndexNavigationResponse();
        $response->setCategory($category);

        return $this->success($response->toArray());
    }


    #[OA\Get(path: '/api/game/visitor/index/index', summary: '首页:默认数据', security: [['bearerAuth' => []]], tags: ['首页'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: GameVisitorIndexIndexRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: GameCommonListBriefItemResponse::class))]
    public function index()
    {
        $category = (new CategoryService())->getList();


        return $this->success();
    }

}