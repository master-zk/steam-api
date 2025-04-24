<?php

namespace app\bundles\game\services;

use app\const\Table;
use app\enums\common\IsEnum;
use Flame\Support\Facade\DB;

class MenuService
{
    public function getMenu(): array
    {
        $query = DB::table(Table::MENU)
            ->field([
                'id',
                'parent_id',
                'icon',
                'name',
                'rule',
            ])->where('menu', '=', IsEnum::Yes->value)
            ->whereNull('deleted_time');


        return $query->select()->toArray();
    }
}