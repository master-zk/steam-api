<?php

namespace app\bundles\game\services;

use app\api\visitor\enum\MediaTypeEnum;
use app\api\visitor\input\GameInput;
use app\bundles\game\jobs\GetSteamGameInfoJob;
use app\bundles\manage\enums\CallLogStatCallTypeEnum;
use app\bundles\manage\enums\CallLogStatRelationTypeEnum;
use app\bundles\manage\enums\CallLogStatTimeTypeEnum;
use app\const\Table;
use app\exception\CustomException;
use Flame\Support\Facade\DB;
use think\db\Query;

class GameService
{
    public function safeInsertGetId(GameInput $row)
    {
        $commonService = new CommonService();
        if (!$commonService->containsCnStr($row->title)) {
            $cnName = $commonService->transStrSingle($row->title, '');
            if ($cnName) {
                $row->title = $cnName;
            }
        }

        $gameId = DB::table(Table::GAMES)
            ->where('platform_id', '=', $row->platform_id)
            ->where('external_id', '=', $row->external_id)
            ->value('id', 0);
        if ($gameId == 0) {
            $gameId = DB::table(Table::GAMES)
                ->insertGetId($row->toArray());
        }

        return $gameId;
    }


    public function isCnCate($name): bool
    {
        if (empty($name)) {

            return false;
        }

        preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $name, $matches);

        return !empty($matches);
    }

    public function transReleaseDate($date): string
    {
        if ((new CommonService())->containsCnStr($date)) {
            /*$releaseDate = date('Y-m-d', strtotime($date));
            dump($releaseDate);
            $filtered  = preg_replace('/[\x{4e00}-\x{9fa5}]/u', '', $date);
            $filtered  = preg_replace('/\s+/u', ' ', $filtered);
            dump($filtered, $releaseDate);*/
            $filtered = (new CommonService())->transStrSingle($date, 'zh-Hans', 'en');
        } else {
            $filtered = $date;
        }

        $releaseTime = strtotime($filtered);
        if ($releaseTime) {
            return date('Y-m-d', strtotime($filtered));

        } else {

            return false;
        }
    }

    public function parseImageMediaUuid(string $url)
    {
        if (empty($url)) {
            return '';
        }

        $ret = parse_url($url, PHP_URL_PATH);
        if (!empty($ret)) {
            $ret1 = explode('/', $ret);
            $ret2 = $ret1[count($ret1) - 1];

            return explode('.', $ret2)[0];
        } else {

            return $url;
        }
    }

    public function safeInsertMediaGetId(array $row)
    {
        if (empty($row)) {

            return 0;
        }

        $dbId = DB::table(Table::GAME_MEDIA)
            ->where('game_id', '=', $row['game_id'])
            ->where('media_type', '=', $row['media_type'])
            ->where('media_label', '=', $row['media_label'])
            ->where('media_uuid', '=', $row['media_uuid'])
            ->value('id', 0);
        if ($dbId == 0) {
            $dbId = DB::table(Table::GAME_MEDIA)
                ->insertGetId($row);
        }

        return $dbId;
    }

    public function safeInsertPriceGetId(array $row)
    {
        if (empty($row)) {

            return 0;
        }

        $dbId = DB::table(Table::GAME_PRICE)
            ->where('game_id', '=', $row['game_id'])
            ->where('price_currency', '=', $row['price_currency'])
            ->value('id', 0);
        if ($dbId == 0) {
            $dbId = DB::table(Table::GAME_PRICE)
                ->insertGetId($row);
        }

        return $dbId;
    }

    public function safeInsertOsRequirementGetId(array $row)
    {
        if (empty($row)) {

            return 0;
        }

        $dbId = DB::table(Table::GAME_OS_REQUIREMENTS)
            ->where('game_id', '=', $row['game_id'])
            ->where('os', '=', $row['os'])
            ->where('requirement_type', '=', $row['requirement_type'])
            ->value('id', 0);
        if ($dbId == 0) {
            $dbId = DB::table(Table::GAME_OS_REQUIREMENTS)
                ->insertGetId($row);
        }

        return $dbId;
    }

    public function query(array $cond, int $page, int $pageSize): array
    {
        // 列表
        $query = $this->generateQuery($cond);
        $rows = $query
            ->order('a.id', 'asc')
            ->paginate([
                'page' => $page,
                'list_rows' => $pageSize,
            ])->toArray();
        /*if (count($rows['data']) > 0) {
            $gameIds = array_column($rows['data'], 'id');
            $gameCategory = DB::table(Table::GAME_CATEGORY_RELATION)
                ->where('game_id', 'in', $gameIds)
                ->field([
                    'game_id',
                    'category_id',
                ])
                ->select()
                ->toArray();
            $categoryIds = [];
            $gameCategoryKey = [];
            foreach ($gameCategory as $v) {
                $gameCategoryKey[$v['game_id']][] = $v['category_id'];
                $categoryIds[$v['category_id']] = 1;
            }
            //dd($gameCategoryKey);
            $categoryIds = array_keys($categoryIds);
            $categoryMap = DB::table(Table::CATEGORIES)
                ->where('id', 'in', $categoryIds)
                ->column('name', 'id');
            foreach ($rows['data'] as &$row) {
                $row['categories'] = [];
                if (!empty($gameCategoryKey[$row['id']])) {
                    foreach ($gameCategoryKey[$row['id']] as $v) {
                        if (isset($categoryMap[$v])) {
                            $row['categories'][] = [
                                'id' => $v,
                                'name' => $categoryMap[$v],
                            ];
                        }
                    }
                }
            }
            unset($row);
        }*/

        return $rows;
    }

    public function top(string $type, $limit = 20): array
    {
        // 列表
        $gameIds = $this->getTopGameIds($type);
        if (count($gameIds) > 20) {
            $gameIds = array_slice($gameIds, 0, 20);
        }
        $cond = [
            'id' => $gameIds,
        ];
        $query = $this->generateQuery($cond);
        $rows = $query
            ->order('a.id', 'asc')
            ->limit($limit)
            ->select()->toArray();

        $ret = [];
        $rowMap = array_column($rows, null, 'id');
        foreach ($gameIds as $gameId) {
            if (isset($rowMap[$gameId])) {
                $ret[] = $rowMap[$gameId];
            }
        }

        return $ret;
    }

    protected function getTopGameIds(int $type): array
    {
        switch ($type) {
            case 1:
                $file = runtime_path('steam/top/today_player.html');
                break;
            case 2:
                $file = runtime_path('steam/top/cn_seller.html');
                break;
            case 3:
                $file = runtime_path('steam/top/all_seller.html');
                break;
            default:
                $file = runtime_path('steam/top/all_player.html');
                break;
        }

        return $this->parseTodayPlayerTopHtml($file);
    }


    public function generateQuery(array $cond, $fields = []): Query
    {
        $fields = $fields ?: [
            'a.id',
            'a.title',
            'a.capsule_image',
            'a.short_description',
        ];
        $query = DB::table(Table::GAMES)->alias('a')
            ->field($fields)
            ->whereNull('a.deleted_time');

        if (!empty($cond['id'])) {
            if (is_array($cond['id'])) {
                $query->whereIn('a.id', $cond['id']);
            } else {
                $query->where('a.id', '=', $cond['platform_id']);

            }
        }
        if (!empty($cond['platform_id'])) {
            $query->where('a.platform_id', '=', $cond['platform_id']);
        }
        if (!empty($cond['keyword'])) {
            $query->where('a.title', 'like', "%{$cond['keyword']}%");
        }
        if (!empty($cond['category_ids'])) {
            $query->where('a.id', 'in', function ($q) use ($cond) {
                $q->table(Table::GAME_CATEGORY_RELATION)->where('category_id', 'in', $cond['category_ids'])->field('game_id');
            });
        }

        return $query;
    }

    public function detail($id)
    {
        $game = DB::table(Table::GAMES)
            ->where('id', $id)
            ->field([
                'id',
                'external_id',
                'title',
                'capsule_image',
                'description',
                'short_description',
                'coming_soon',
                'release_date',
                'is_free',
                'age_rating',
                'website_url',
                'os_windows',
                'os_mac',
                'os_linux',
                'review_positive',
                'review_negative',
            ])
            ->findOrEmpty();
        if (empty($game)) {
            not_found_exception();
        }

        $screenshots = DB::table(Table::GAME_MEDIA)
            ->where('game_id', '=', $id)
            ->where('media_type', '=', MediaTypeEnum::IMAGE->value)
            ->where('media_label', '=', 'screenshots')
            ->order('sort_order', 'asc')
            ->column('media_thumbnail');

        $categories = DB::table(Table::GAME_CATEGORY_RELATION)->alias('a')
            ->leftJoin(Table::CATEGORIES . ' b', 'b.id=a.category_id')
            ->where('a.game_id', '=', $id)
            ->column('b.name');
        $price = DB::table(Table::GAME_PRICE)
            ->where('game_id', '=', $id)
            ->field([
                'price_symbol',
                'price_initial',
                'price_final',
                'discount',
            ])
            ->findOrEmpty();

        $game['screenshots'] = $screenshots;
        $game['price_overview'] = $price;
        $game['category'] = $categories;
        $game['chart'] = $this->getGameHistoryScore(31);

        return $game;
    }

    public function getGameHistoryScore($day = 31): array
    {
        $ret  = [];
        $beginTime = strtotime("-{$day} day");
        for ($i = 0; $i < $day; $i++) {
            $indexTime = $beginTime + $i * 86400;
            $ret[] = [
                'timestamp' => $beginTime,
                'date' => date('Y-m-d', $indexTime),
                'score' => rand(75, 95) + round(rand(0, 10) / 10, 2),
            ];
        }

        return $ret;
    }

    public function parseTodayPlayerTopHtml($file): array
    {
        $html = file_get_contents($file);
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($html);
        libxml_clear_errors();
        $domXpath = new \DOMXPath($dom);
        $query = '//tbody//a[@class="_2C5PJOUH6RqyuBNEwaCE9X"]/@href';
        $hrefs = $domXpath->query($query);

        $gameIds = [];
        // 遍历结果
        foreach ($hrefs as $href) {
            $url = $href->nodeValue;
            $appid = $this->extractAppIdFromUrl($url);
            if (!empty($appid)) {
                $gameId = DB::table(Table::GAMES)
                    ->where('external_id', '=', $appid)
                    ->value('id');
                if ($gameId) {
                    $gameIds[] = $gameId;
                }
            }
        }

        return $gameIds;
    }

    public function extractAppIdFromUrl($url): ?string
    {
        // 解析 URL 获取路径部分
        $path = parse_url($url, PHP_URL_PATH);

        // 使用正则表达式匹配数字部分
        if (preg_match('/\/app\/(\d+)/', $path, $matches)) {
            return $matches[1];
        }

        return null; // 如果没有匹配到数字，返回 null
    }

}