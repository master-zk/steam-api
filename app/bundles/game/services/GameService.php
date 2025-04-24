<?php

namespace app\bundles\game\services;

use app\api\visitor\input\GameInput;
use app\bundles\manage\enums\CallLogStatCallTypeEnum;
use app\bundles\manage\enums\CallLogStatRelationTypeEnum;
use app\bundles\manage\enums\CallLogStatTimeTypeEnum;
use app\const\Table;
use Flame\Support\Facade\DB;
use think\db\Query;

class GameService
{
    public function safeInsertGetId(GameInput $row)
    {
        $commonService = new CommonService();
        if (!$commonService->containsCnStr($row->title)) {
            $cnName = $commonService->transStrSingle($row->title);
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
        $gameIds = [1,2,3,4,5,6,7];
        $cond = [
            'id' => $gameIds,
        ];
        $query = $this->generateQuery($cond);
        $rows = $query
            ->order('a.id', 'asc')
            ->limit($limit)
            ->select()->toArray();

        $ret = [];
        $rowMap = array_column($rows, 'id');
        foreach ($gameIds as $gameId) {
            if (isset($rowMap[$gameId])) {
                $ret[] = $rowMap[$gameId];
            }
        }

        return $ret;
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
        if (!empty($cond['category_ids'])) {
            $query->where('a.id', 'in', function ($q) use ($cond) {
                $q->table(Table::GAME_CATEGORY_RELATION)->where('category_id', 'in', $cond['category_ids'])->field('game_id');
            });
        }

        return $query;
    }

}