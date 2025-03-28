<?php

namespace app\bundles\game\controller\visitor;

use app\api\visitor\controller\VisitorBaseController;
use app\bundles\game\request\visitor\GameVisitorIndexIndexRequest;
use app\bundles\game\response\common\GameCommonListBriefItemResponse;
use OpenApi\Attributes;

class IndexController extends VisitorBaseController
{
    #[Attributes\Get(path: '/api/game/visitor/index/index', summary: '首页:默认数据', security: [['bearerAuth' => []]], tags: ['首页'])]
    #[Attributes\RequestBody(required: true, content: new Attributes\JsonContent(ref: GameVisitorIndexIndexRequest::class))]
    #[Attributes\Response(response: 200, description: 'OK', content: new Attributes\JsonContent(ref: GameCommonListBriefItemResponse::class))]
    public function index()
    {
        dd(__METHOD__);
    }

}