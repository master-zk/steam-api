<?php

namespace app\bundles\game\controller\visitor;

use app\api\visitor\controller\VisitorBaseController;
use app\bundles\game\response\visitor\IndexMenuResponse;
use app\bundles\game\services\MenuService;
use Flame\Http\Response;
use OpenApi\Attributes as OA;

class IndexController extends VisitorBaseController
{
    #[OA\Get(path: '/api/game/visitor/index/menu', summary: '菜单', security: [['bearerAuth' => []]], tags: ['首页'])]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: IndexMenuResponse::class))]
    public function menu(): Response
    {
        $menus = (new MenuService())->getMenu();
        $response = new IndexMenuResponse();
        $response->setMenu($menus);

        return $this->success($response->toArray());
    }
}