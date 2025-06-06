<?php

declare(strict_types=1);

use app\const\Table;
use Flame\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateGameStatTable extends AbstractMigration
{
    public function change(): void
    {
        $tableName = Table::GAME_STAT;

        if ($this->hasTable($tableName)) {

            return;
        }

        $table = $this->table($tableName, [
            'collation' => 'utf8mb4_0900_ai_ci',
            'comment' => '游戏报表',
            'engine' => 'InnoDB',
            'signed' => false,
            'id' => false, // 不使用默认主键逻辑
            'primary_key' => 'id', // 重新指定主键为id，下面需要设置id类型
        ]);

        $table
            ->addColumn(Column::unsignedBigInteger('id')->setNull(false)->setIdentity(true)->setIncrement(1)->setComment('主键'))
            ->addColumn(Column::unsignedBigInteger('game_id')->setNull(false)->setDefault(0)->setComment('游戏ID'))
            ->addColumn(Column::unsignedTinyInteger('time_type')->setNull(false)->setDefault(0)->setComment('时间类型：1=小时 2=天 3=周 4=月 5=月 6=年'))
            ->addColumn(Column::unsignedTinyInteger('score_type')->setNull(false)->setDefault(0)->setComment('分数计算类型：1=综合热门 2=销量最好 3=最多人玩'))
            ->addColumn(Column::string('time_alias', 100)->setNull(false)->setDefault('')->setComment('时间段别名'))
            ->addColumn(Column::dateTime('begin_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setComment('开始时间'))
            ->addColumn(Column::dateTime('end_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setComment('结束时间'))
            ->addColumn(Column::decimal('score')->setNull(false)->setDefault(0)->setComment('综合评分'))
            ->addColumn(Column::text('score_weight_detail')->setNull(true)->setDefault('')->setComment('评分权重详细'))
            ->addColumn(Column::dateTime('created_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setComment('创建时间'))
            ->addColumn(Column::dateTime('updated_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setUpdate('CURRENT_TIMESTAMP')->setComment('更新时间'))
            ->addIndex(['game_id'], ['name' => 'idx_game_id'])
            ->addIndex(['time_type', 'score_type', 'begin_time'], ['name' => 'idx_time_type_score_type_begin_time'])
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
