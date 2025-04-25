<?php

namespace app\bundles\game\controller\visitor;

use app\api\visitor\controller\VisitorBaseController;
use app\bundles\game\request\visitor\GameVisitorGameQueryRequest;
use app\bundles\game\response\visitor\GameCommonListBriefItemResponse;
use app\bundles\game\response\visitor\GameVisitorGameDetailResponse;
use app\bundles\game\response\visitor\GameVisitorGameQueryResponse;
use app\bundles\game\services\GameService;
use app\bundles\manage\request\employee\history\HistoryAllQueryRequest;
use app\exception\CustomException;
use Flame\Http\Response;
use Flame\Support\Facade\Log;
use OpenApi\Attributes as OA;

class GameController extends VisitorBaseController
{
    #[OA\Post(path: '/api/game/visitor/game/query', summary: '游戏列表', security: [['bearerAuth' => []]], tags: ['游戏'])]
    #[OA\QueryParameter(name: 'page', description: '页标', required: true, example: 1)]
    #[OA\QueryParameter(name: 'pageSize', description: '页长', required: true, example: 10)]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: GameVisitorGameQueryRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: GameVisitorGameQueryResponse::class))]
    public function query(): Response
    {
        try {
            $page = intval($this->input('page', 1));
            $pageSize = intval($this->input('pageSize', 10));

            $request = $this->requestBody();
            $v = new GameVisitorGameQueryRequest;
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $option = [
                'platform_id' => 1,
            ];
            if (! empty($request['keyword'])) {
                $option['keyword'] = htmlspecialchars($request['keyword']);
            }
            if (! empty($request['category_ids'])) {
                $option['category_ids'] = $request['category_ids'];
            }
            $ret = (new GameService())->query($option, $page, $pageSize);

            return $this->success($ret);
        } catch (CustomException $e) {

            return $this->fail($e->getMessage());
        } catch (\Throwable $e) {
            Log::error($e);

            return $this->fail('请求失败');
        }
    }

    #[OA\Get(path: '/api/game/visitor/game/top', summary: '游戏榜单', security: [['bearerAuth' => []]], tags: ['游戏'])]
    #[OA\QueryParameter(name: 'type', description: '1=综合热门 2=销量最好 3=最多人玩', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(type: "array", items: new OA\Items(ref: GameCommonListBriefItemResponse::class)))]
    public function top(): Response
    {
        try {
            $type = $this->input('type', 1);
            $limit = 20;
            $ret = (new GameService())->top($type, $limit);

            return $this->success($ret);
        } catch (CustomException $e) {

            return $this->fail($e->getMessage());
        } catch (\Throwable $e) {
            Log::error($e);

            return $this->fail('请求失败');
        }
    }

    #[OA\Get(path: '/api/game/visitor/game/detail', summary: '游戏详情', security: [['bearerAuth' => []]], tags: ['游戏'])]
    #[OA\QueryParameter(name: 'id', description: '游戏ID', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: GameVisitorGameDetailResponse::class))]
    public function detail(): Response
    {
        try {
            $id = intval($this->input('id', 0));
            if (empty($id)) {
                throw new CustomException('参数异常');
            }
            $ret = (new GameService())->detail($id);

            return $this->success($ret);
        } catch (CustomException $e) {

            return $this->fail($e->getMessage());
        } catch (\Throwable $e) {
            Log::error($e);

            return $this->fail('请求失败');
        }
    }
}