<?php

declare(strict_types=1);

use app\const\Table;
use Flame\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateGameMediaTable extends AbstractMigration
{
    public function change(): void
    {
        $tableName = Table::GAME_MEDIA;

        if ($this->hasTable($tableName)) {

            return;
        }

        $table = $this->table($tableName, [
            'collation' => 'utf8mb4_0900_ai_ci',
            'comment' => '游戏媒体资源表',
            'engine' => 'InnoDB',
            'signed' => false,
            'id' => false, // 不使用默认主键逻辑
            'primary_key' => 'id', // 重新指定主键为id，下面需要设置id类型
        ]);

        $table
            ->addColumn(Column::unsignedBigInteger('id')->setNull(false)->setIdentity(true)->setIncrement(1)->setComment('主键'))
            ->addColumn(Column::unsignedBigInteger('game_id')->setNull(false)->setDefault(0)->setComment('游戏ID'))
            ->addColumn(Column::string('media_type', 50)->setNull(false)->setDefault('')->setComment('资源类型：image=图片 video=视频 audio=音频'))
            ->addColumn(Column::string('media_label', 50)->setNull(false)->setDefault('')->setComment('资源标签(如: header_image capsule_image screenshots movie_thumbnail_image mp4_movie webm_movie等)'))
            ->addColumn(Column::string('media_uuid', 512)->setNull(false)->setDefault('')->setComment('资源唯一标识'))
            ->addColumn(Column::string('media_url', 512)->setNull(false)->setDefault('')->setComment('资源URL'))
            ->addColumn(Column::text('description')->setNull(true)->setComment('资源描述（如视频标题、截图说明）'))
            ->addColumn(Column::integer('sort_order')->setNull(false)->setDefault(0)->setComment('排序优先级（数值越小越靠前）'))
            ->addColumn(Column::dateTime('created_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setComment('创建时间'))
            ->addColumn(Column::dateTime('updated_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setUpdate('CURRENT_TIMESTAMP')->setComment('更新时间'))
            ->addIndex(['game_id'], ['name' => 'idx_game_id'])
            ->addIndex(['media_uuid'], ['name' => 'idx_media_uuid'])
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
