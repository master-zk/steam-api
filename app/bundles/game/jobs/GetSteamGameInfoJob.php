<?php

namespace app\bundles\game\jobs;

use app\bundles\game\services\SteamGameService;
use app\const\Table;
use app\enums\common\RunStatusEnum;
use Flame\Queue\Contracts\JobInterface;
use Flame\Support\Facade\DB;

class GetSteamGameInfoJob implements JobInterface
{
    public function handle(int $i = 0, int $pageSize = 50)
    {
        $service = new SteamGameService();
        $params = $service->getTopSellersReviewsParams($i, $pageSize);
        dump($params);
        $appIds = $service->getGameAppIds($params);
        dump($appIds);
        foreach ($appIds as $v) {
            $appid = (string)$v;
            $this->loadGameByAppId($appid);
        }
    }

    public function loadGameByAppId($appid): void
    {
        $service = new SteamGameService();
        dump($appid);
        $oldRow = DB::table(Table::GAME_RAW)
            ->field(['id', 'load_run_status'])
            ->where('platform_id', $service->platformId)
            ->where('external_id', $appid)
            ->findOrEmpty();
        $down = false;
        $downType = '';
        $oldRowId = 0;

        if (empty($oldRow)) {
            $down = true;
            $downType = 'create';
        } elseif ($oldRow['load_run_status'] == 4) {
            $down = true;
            $downType = 'update';
            $oldRowId = $oldRow['id'];
        }

        if ($down) {
            $detail = $this->downGameDetail($appid);
            sleep(1);
            if (isset($detail[$appid]['success']) && isset($detail[$appid]['data']) && $detail[$appid]['success'] && $detail[$appid]['data']) {
                $gameData = $detail[$appid]['data'];
                $gameType = $gameData['type'] ?? null;
                if ($gameType != 'game') {
                    dump('非游戏数据');
                    return;
                }
                $insertData = [
                    'platform_id' => $service->platformId,
                    'external_id' => $appid,
                    'last_detail' => serialize($gameData),
                    'detail' => serialize($gameData),
                    'load_time' => date('Y-m-d H:i:s'),
                    'load_run_status' => RunStatusEnum::SUCCESS->value,
                    'sync_run_status' => RunStatusEnum::WAITING->value,
                ];
            } else {
                dump('无法获取游戏数据');
                $insertData = [
                    'platform_id' => $service->platformId,
                    'external_id' => $appid,
                    'load_time' => date('Y-m-d H:i:s'),
                    'load_run_status' => RunStatusEnum::FAIL->value,
                ];
            }

            if ($downType == 'create') {
                DB::table(Table::GAME_RAW)->insert($insertData);
            } elseif ($downType == 'update' && !empty($insertData['detail'])) {
                DB::table(Table::GAME_RAW)->where('id', $oldRowId)->update($insertData);
            }
        }
    }

    public function downGameDetail($appid): mixed
    {
        $service = new SteamGameService();
        $detail = $service->getGameDetail($appid, 'cn', 'cn', false);
        sleep(1);
        if (!(isset($detail[$appid]['success']) && isset($detail[$appid]['data']) && $detail[$appid]['success'] && $detail[$appid]['data'])) {
            $detail = $service->getGameDetail($appid, 'cn', 'en', false);
        }

        return $detail;
    }
}