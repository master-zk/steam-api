<?php

declare(strict_types=1);

use Flame\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;
use app\const\Table;

final class CreatePlatformsTable extends AbstractMigration
{
    public function change(): void
    {
        $tableName = Table::PLATFORMS;

        if ($this->hasTable($tableName)) {
            return;
        }

        $this->table($tableName, [
            'collation' => 'utf8mb4_0900_ai_ci',
            'comment' => '平台表',
            'engine' => 'InnoDB',
            'signed' => false,
        ])->addColumn(Column::string('name', 30)->setNull(false)->setDefault('')->setComment('平台名称'))
            ->addColumn(Column::dateTime('created_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setComment('创建时间'))
            ->addColumn(Column::dateTime('updated_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setUpdate('CURRENT_TIMESTAMP')->setComment('更新时间'))
            ->addColumn(Column::dateTime('deleted_time')->setNullable()->setComment('删除时间'))
            ->save();
    }
}
