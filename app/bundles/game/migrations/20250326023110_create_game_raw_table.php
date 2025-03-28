<?php

declare(strict_types=1);

use app\const\Table;
use Flame\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateGameRawTable extends AbstractMigration
{
    public function change(): void
    {
        $tableName = Table::GAME_RAW;

        if ($this->hasTable($tableName)) {

            return;
        }

        $table = $this->table($tableName, [
            'collation' => 'utf8mb4_0900_ai_ci',
            'comment' => '游戏-原始数据表',
            'engine' => 'InnoDB',
            'signed' => false,
            'id' => false, // 不使用默认主键逻辑
            'primary_key' => 'id', // 重新指定主键为id，下面需要设置id类型
        ]);

        $table
            ->addColumn(Column::unsignedBigInteger('id')->setNull(false)->setIdentity(true)->setIncrement(1)->setComment('主键'))
            ->addColumn(Column::unsignedInteger('platform_id')->setNull(false)->setDefault(0)->setComment('平台ID'))
            ->addColumn(Column::string('external_id', 255)->setNull(false)->setDefault('')->setComment('平台游戏唯一标识(如:Steam-appid)'))
            ->addColumn(Column::longText('last_detail')->setNull(true)->setComment('上次游戏原始数据'))
            ->addColumn(Column::longText('detail')->setNull(true)->setComment('游戏原始数据'))
            ->addColumn(Column::dateTime('load_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setComment('数据获取时间'))
            ->addColumn(Column::dateTime('sync_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setComment('数据同步时间'))
            ->addColumn(Column::unsignedInteger('load_run_status')->setNull(false)->setDefault(0)->setComment('数据获取状态: 1=成功 2=待执行 3=执行中 4=失败'))
            ->addColumn(Column::unsignedInteger('load_error_count')->setNull(false)->setDefault(0)->setComment('数据获取失败次数'))
            ->addColumn(Column::unsignedInteger('sync_run_status')->setNull(false)->setDefault(0)->setComment('数据同步状态：1=成功 2=待执行 3=执行中 4=失败'))
            ->addColumn(Column::unsignedInteger('sync_error_count')->setNull(false)->setDefault(0)->setComment('数据获取失败次数'))
            ->addColumn(Column::dateTime('created_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setComment('创建时间'))
            ->addColumn(Column::dateTime('updated_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setUpdate('CURRENT_TIMESTAMP')->setComment('更新时间'))
            ->addIndex(['platform_id', 'external_id'], ['name' => 'idx_platform_external_id'])
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
