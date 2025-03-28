<?php

declare(strict_types=1);

use app\const\Table;
use Flame\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateGamesTable extends AbstractMigration
{
    public function change(): void
    {
        $tableName = Table::GAMES;

        if ($this->hasTable($tableName)) {

            return;
        }

        $table = $this->table($tableName, [
            'collation' => 'utf8mb4_0900_ai_ci',
            'comment' => '游戏主表',
            'engine' => 'InnoDB',
            'signed' => false,
            'id' => false, // 不使用默认主键逻辑
            'primary_key' => 'id', // 重新指定主键为id，下面需要设置id类型
        ]);

        $table
            ->addColumn(Column::unsignedBigInteger('id')->setNull(false)->setIdentity(true)->setIncrement(1)->setComment('主键'))
            ->addColumn(Column::unsignedInteger('platform_id')->setNull(false)->setDefault(0)->setComment('平台ID'))
            ->addColumn(Column::string('external_id', 255)->setNull(false)->setDefault('')->setComment('台上的游戏唯一标识（如 Steam 的 appid）'))
            ->addColumn(Column::string('title', 255)->setNull(false)->setDefault('')->setComment('游戏名称'))
            ->addColumn(Column::string('capsule_image', 512)->setNull(false)->setDefault('')->setComment('列表缩略图'))
            ->addColumn(Column::text('description')->setNull(true)->setComment('游戏详细描述'))
            ->addColumn(Column::text('short_description')->setNull(true)->setComment('简短描述'))
            ->addColumn(Column::unsignedTinyInteger('coming_soon')->setNull(true)->setComment('发布状态: 1=已发布 2=未发布'))
            ->addColumn(Column::date('release_date')->setNull(true)->setComment('原始发布日期'))
            ->addColumn(Column::unsignedTinyInteger('is_free')->setNull(false)->setDefault(0)->setComment('是否免费：0=未知 1=是 2=否'))
            ->addColumn(Column::tinyInteger('age_rating')->setNull(false)->setDefault(0)->setComment('年龄限制（如 PEGI 18+）'))
            ->addColumn(Column::string('website_url', 512)->setNull(false)->setDefault('')->setComment('游戏官网URL'))
            ->addColumn(Column::unsignedTinyInteger('os_windows')->setNull(false)->setDefault(0)->setComment('是否支持windows：0=未知 1=是 2=否'))
            ->addColumn(Column::unsignedTinyInteger('os_mac')->setNull(false)->setDefault(0)->setComment('是否支持mac：0=未知 1=是 2=否'))
            ->addColumn(Column::unsignedTinyInteger('os_linux')->setNull(false)->setDefault(0)->setComment('是否支持linux：0=未知 1=是 2=否'))
            ->addColumn(Column::dateTime('created_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setComment('创建时间'))
            ->addColumn(Column::dateTime('updated_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setUpdate('CURRENT_TIMESTAMP')->setComment('更新时间'))
            ->addColumn(Column::dateTime('deleted_time')->setNullable()->setComment('删除时间'))
            ->addIndex(['platform_id', 'external_id'], ['name' => 'idx_platform_external_id'])
            ->addIndex(['release_date'], ['name' => 'idx_release_date'])
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
