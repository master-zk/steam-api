<?php

declare(strict_types=1);

namespace app\console\commands;

use app\const\Table;
use Flame\Support\Facade\DB;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncCallNumberLocationCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('sync-call-number-location')
            ->setDescription('同步号码归属地.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->executeNumber1(); // 只有新增没有更新
        $this->executeNumber2(); // 只有新增没有更新

        return 0;
    }

    private function executeNumber1(): void
    {
        $indexId = 0;
        //dump('手机号');
        // 手机号
        while (true) {
            $rows = DB::table(Table::PHONE_LOCATION)
                ->where('id', '>', $indexId)
                ->order('id', 'asc')
                ->limit(200)
                ->select()->toArray();
            if (count($rows) == 0) {
                break;
            }
            $numbers = array_column($rows, 'phone');
            $numberMap = DB::table(Table::CALL_NUMBER_LOCATION)
                ->where('number_type', 1)
                ->whereIn('number', $numbers)
                ->column('id', 'number');
            $batchInsertRow = [];
            foreach ($rows as $row) {
                $indexId = max($indexId, $row['id']);
                $number = $row['phone'];
                $numberType = 1;
                $rowData = [
                    'number' => $number,
                    'number_type' => $numberType,
                    'pref' => $row['pref'],
                    'province' => $row['province'],
                    'city' => $row['city'],
                    'isp' => $row['isp'],
                    'isp_type' => $row['isp_type'],
                    'post_code' => $row['post_code'],
                    'city_code' => $row['city_code'],
                    'region_id' => $row['area_code'],
                ];
                if (! isset($numberMap[$number])) {
                    $batchInsertRow[] = $rowData;
                }
            }
            if (count($batchInsertRow) > 0) {
                DB::table(Table::CALL_NUMBER_LOCATION)->insertAll($batchInsertRow);
                unset($batchInsertRow);
            }
            //dump($indexId);
        }
    }

    private function executeNumber2(): void
    {
        //dump('座机号');
        // 座机号
        // 查询城市区号(排除港澳台)
        $cityCodes = DB::table(Table::REGION)
            ->where('level', '=', 2)
            ->whereNotIn('parent_id', ['710000', '810000', '820000'])
            ->column('city_code');
        $locationMap = DB::table(Table::PHONE_LOCATION)
            ->whereIn('city_code', $cityCodes)
            ->whereNotNull('area_code')
            ->whereNotNull('isp')
            ->group('city_code')
            ->field([
                'city_code',
                'min(id) id',
            ])
            ->select()->toArray();
        $locationIds = array_column($locationMap, 'id');
        $rows = DB::table(Table::PHONE_LOCATION)
            ->whereIn('id', $locationIds)
            ->select()->toArray();
        $numberMap = DB::table(Table::CALL_NUMBER_LOCATION)
            ->where('number_type', 2)
            ->whereIn('number', $cityCodes)
            ->column('id', 'number');
        $batchInsertRow = [];

        foreach ($rows as $row) {
            $cityCode = $row['city_code'];
            $regionId = $row['area_code'];
            $rowData = [
                'number' => $cityCode,
                'number_type' => 2,
                'pref' => $cityCode,
                'province' => $row['province'],
                'city' => $row['city'],
                'isp' => '',
                'isp_type' => 0,
                'post_code' => $row['post_code'],
                'city_code' => $cityCode,
                'region_id' => $regionId,
            ];
            if (! isset($numberMap[$cityCode])) {
                $batchInsertRow[] = $rowData;
            }
        }
        if (count($batchInsertRow) > 0) {
            DB::table(Table::CALL_NUMBER_LOCATION)->insertAll($batchInsertRow);
            unset($batchInsertRow);
        }
    }
}
