<?php

declare(strict_types=1);

use app\const\Table;
use Flame\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateGameOsRequirementsTable extends AbstractMigration
{
    public function change(): void
    {
        $tableName = Table::GAME_OS_REQUIREMENTS;

        if ($this->hasTable($tableName)) {

            return;
        }

        $table = $this->table($tableName, [
            'collation' => 'utf8mb4_0900_ai_ci',
            'comment' => '游戏系统需求表',
            'engine' => 'InnoDB',
            'signed' => false,
            'id' => false, // 不使用默认主键逻辑
            'primary_key' => 'id', // 重新指定主键为id，下面需要设置id类型
        ]);

        $table
            ->addColumn(Column::unsignedBigInteger('id')->setNull(false)->setIdentity(true)->setIncrement(1)->setComment('主键'))
            ->addColumn(Column::unsignedBigInteger('game_id')->setNull(false)->setDefault(0)->setComment('游戏ID'))
            ->addColumn(Column::string('os', 50)->setNull(false)->setDefault('')->setComment('系统类型：windows mac linux'))
            ->addColumn(Column::string('requirement_type', 50)->setNull(false)->setDefault('')->setComment('需求类型：minimum recommended'))
            ->addColumn(Column::text('details')->setNull(true)->setComment('具体要求'))
            ->addColumn(Column::dateTime('created_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setComment('创建时间'))
            ->addColumn(Column::dateTime('updated_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setUpdate('CURRENT_TIMESTAMP')->setComment('更新时间'))
            ->addIndex(['game_id'], ['name' => 'idx_game_id'])
            ->create();

        // 分区
        $this->execute("
            ALTER TABLE `{$tableName}`
            PARTITION BY HASH ((`id` % 12)) (
                PARTITION p0 ENGINE = InnoDB,
                PARTITION p1 ENGINE = InnoDB,
                PARTITION p2 ENGINE = InnoDB,
                PARTITION p3 ENGINE = InnoDB,
                PARTITION p4 ENGINE = InnoDB,
                PARTITION p5 ENGINE = InnoDB,
                PARTITION p6 ENGINE = InnoDB,
                PARTITION p7 ENGINE = InnoDB,
                PARTITION p8 ENGINE = InnoDB,
                PARTITION p9 ENGINE = InnoDB,
                PARTITION p10 ENGINE = InnoDB,
                PARTITION p11 ENGINE = InnoDB
            )
        ");
    }
}
