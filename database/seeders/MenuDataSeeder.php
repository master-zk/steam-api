<?php

declare(strict_types=1);


use app\const\Table;
use app\enums\common\IsEnum;
use app\enums\common\StatusEnum;
use Flame\Support\Facade\DB;
use Flame\Support\Facade\Log;
use Phinx\Seed\AbstractSeed;

class MenuDataSeeder extends AbstractSeed
{
    public function run(): void
    {
        try {
            // 菜单数据+api数据
            $items = $this->getItems();
            $this->saveItemTree($items);

        } catch (\Throwable $e) {
            Log::error($e);
        }
    }

    public function saveItemTree($items, $pid = 0, $level = 1): void
    {
        $tableName = Table::MENU;
        foreach ($items as $item) {
            $oldItem = DB::table($tableName)
                ->where('rule', '=', $item['rule'])
                ->whereNull('deleted_time')
                ->find();
            $updateItem = [
                'module' => $item['module'],
                'rule' => $item['rule'],
                'name' => $item['name'],
                'parent_id' => $pid,
                'icon' => $item['icon'],
                'menu' => $item['menu'] ?? IsEnum::Not->value,
                'status' => $item['status'] ?? StatusEnum::Enabled->value,
            ];
            if (empty($oldItem)) {
                $itemId = DB::table($tableName)->insertGetId($updateItem);
            } else {
                $itemId = $oldItem['id'];
                DB::table($tableName)->where('id', $itemId)->update($updateItem);
            }

            if (!empty($item['child'])) {
                $this->saveItemTree($item['child'], $itemId, $level + 1);
            }
        }
    }

    private function getItems(): array
    {
        return [
            [
                'module' => 'visitor',
                'rule' => 'game-library',
                'name' => '游戏库',
                'parent_id' => 0,
                'icon' => 'menu-01',
                'menu' => IsEnum::Yes->value,
                'status' => StatusEnum::Enabled->value,
                'child' => [],
            ],
            [
                'module' => 'visitor',
                'rule' => 'game-top',
                'name' => '游戏榜单',
                'parent_id' => 0,
                'icon' => 'menu-02',
                'menu' => IsEnum::Yes->value,
                'status' => StatusEnum::Enabled->value,
                'child' => [
                    [
                        'module' => 'visitor',
                        'rule' => 'game-top/hot',
                        'name' => '综合热门',
                        'parent_id' => 0,
                        'icon' => '',
                        'menu' => IsEnum::Yes->value,
                        'status' => StatusEnum::Enabled->value,
                        'child' => [],
                    ],
                    [
                        'module' => 'visitor',
                        'rule' => 'game-top/sell',
                        'name' => '最近热卖',
                        'parent_id' => 0,
                        'icon' => '',
                        'menu' => IsEnum::Yes->value,
                        'status' => StatusEnum::Enabled->value,
                        'child' => [],
                    ],
                    [
                        'module' => 'visitor',
                        'rule' => 'game-top/play',
                        'name' => '玩家喜爱',
                        'parent_id' => 0,
                        'icon' => '',
                        'menu' => IsEnum::Yes->value,
                        'status' => StatusEnum::Enabled->value,
                        'child' => [],
                    ],
                ],
            ],
        ];
    }
}
