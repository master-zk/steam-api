<?php

namespace app\api\visitor\services;

use app\api\visitor\input\GameInput;
use app\const\Table;
use Flame\Support\Facade\DB;

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

}