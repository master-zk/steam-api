<?php

declare(strict_types=1);

use app\const\Table;
use Flame\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateCategoriesTable extends AbstractMigration
{
    public function change(): void
    {
        $tableName = Table::CATEGORIES;

        if ($this->hasTable($tableName)) {
            return;
        }

        $this->table($tableName, [
            'collation' => 'utf8mb4_0900_ai_ci',
            'comment' => '游戏分类表',
            'engine' => 'InnoDB',
            'signed' => false,
        ])->addColumn(Column::unsignedInteger('platform_id')->setNull(false)->setDefault(0)->setComment('平台ID'))
            ->addColumn(Column::string('external_id', 30)->setNull(false)->setDefault('')->setComment('平台分类标识'))
            ->addColumn(Column::string('name', 30)->setNull(false)->setDefault('')->setComment('分类名称'))
            ->addColumn(Column::string('en_name', 30)->setNull(false)->setDefault('')->setComment('分类名称'))
            ->addColumn(Column::dateTime('created_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setComment('创建时间'))
            ->addColumn(Column::dateTime('updated_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setUpdate('CURRENT_TIMESTAMP')->setComment('更新时间'))
            ->save();
    }
}
