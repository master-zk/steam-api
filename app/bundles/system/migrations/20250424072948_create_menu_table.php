<?php

declare(strict_types=1);

use Flame\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateMenuTable extends AbstractMigration
{
    public function change(): void
    {
        $tableName = \app\const\Table::MENU;
        if ($this->hasTable($tableName)) {

            return;
        }

        $table = $this->table($tableName, [
            'signed' => false,
            'collation' => 'utf8mb4_0900_ai_ci',
            'comment' => '菜单表',
        ]);

        $table->addColumn(Column::string('module')->setNull(false)->setDefault('')->setComment('模块: employee/common/...'))
            ->addColumn(Column::unsignedInteger('parent_id')->setNull(false)->setDefault(0)->setComment('父级ID'))
            ->addColumn(Column::string('icon')->setNull(false)->setDefault('')->setComment('菜单图标'))
            ->addColumn(Column::string('name')->setNull(false)->setDefault('')->setComment('规则名称'))
            ->addColumn(Column::string('rule')->setNull(false)->setDefault('')->setComment('唯一标识'))
            ->addColumn(Column::unsignedTinyInteger('menu')->setNull(false)->setDefault(0)->setComment('是否为菜单项: 1是 2否'))
            ->addColumn(Column::unsignedTinyInteger('status')->setNull(false)->setDefault(0)->setComment('状态: 1正常 2禁用'))
            ->addColumn(Column::unsignedTinyInteger('is_internal')->setNull(false)->setDefault(0)->setComment('是否是内部的: 1=是 2=否'))
            ->addColumn(Column::dateTime('created_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setComment('创建时间'))
            ->addColumn(Column::dateTime('updated_time')->setNull(false)->setDefault('CURRENT_TIMESTAMP')->setUpdate('CURRENT_TIMESTAMP')->setComment('更新时间'))
            ->addColumn(Column::dateTime('deleted_time')->setNullable()->setComment('删除时间'))
            ->addIndex(['rule'], ['unique' => true, 'name' => 'rule'])
            ->create();
    }
}
