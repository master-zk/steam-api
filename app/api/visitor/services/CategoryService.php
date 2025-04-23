<?php

namespace app\api\visitor\services;

use app\const\Table;
use Flame\Support\Facade\DB;

class CategoryService
{
    public function getList(): array
    {
        return DB::table('categories')
            ->field([
                'id',
                'name',
            ])
            ->where('platform_id', 1)
            ->select()
            ->toArray();
    }

    public function safeInsertGetId($genreId, $genreName, $platformId = 1)
    {
        if (empty($genreId) || empty($genreName)) {

            return 0;
        }
        if (!(new CommonService())->isCnStr($genreName)) {

            return 0;
        }

        $dbCateId = DB::table(Table::CATEGORIES)
            ->where('platform_id', '=', $platformId)
            ->where('external_id', '=', $genreId)
            ->value('id', 0);
        if ($dbCateId == 0) {
            $dbCateId = DB::table(Table::CATEGORIES)
                ->insertGetId([
                    'platform_id' => $platformId,
                    'external_id' => $genreId,
                    'name' => $genreName,
                ]);
        }

        return $dbCateId;
    }

    public function bindGame($cateId, $gameId)
    {
        if (empty($cateId) || empty($gameId)) {

            return false;
        }

        $relationId = DB::table(Table::GAME_CATEGORY_RELATION)
            ->where('game_id', '=', $gameId)
            ->where('category_id', '=', $cateId)
            ->value('id', 0);
        if ($relationId == 0) {
            $relationId = DB::table(Table::GAME_CATEGORY_RELATION)
                ->insertGetId([
                    'game_id' => $gameId,
                    'category_id' => $cateId,
                ]);
        }

        return $relationId;
    }

}