<?php

declare(strict_types=1);

namespace Flame\Database\Contracts;

use think\Collection;

interface CurdRepositoryInterface
{
    /**
     * 添加业务数据
     */
    public function create(array $data): mixed;

    /**
     * 批量增加数据
     */
    public function saveAll(array $data, bool $replace = true): Collection;

    /**
     * 按主键ID查询
     */
    public function findOneById(mixed $id): array;

    /**
     * 按条件查询
     *
     * @return mixed
     */
    public function findOneByWhere(array $condition, string $order, string $sort): array;

    /**
     * 查询某个字段的值
     */
    public function value(string $field, array $condition): mixed;

    /**
     * 查询某一列的值
     */
    public function column(string $field, array $condition): array;

    /**
     * 按条件统计数量
     */
    public function count(array $condition): int;

    /**
     * 全部查询
     */
    public function findAll(array $condition, string $order, string $sort): array;

    /**
     * 分页查询
     */
    public function paginate(array $condition, int $page, int $pageSize, string $order, string $sort): array;

    /**
     * 按ID更新数据
     */
    public function updateById(array $data, mixed $id): bool;

    /**
     * 更新数据
     */
    public function update(array $data, array $condition): bool;

    /**
     * 按ID删除数据
     */
    public function deleteById(mixed $id): bool;

    /**
     * 删除数据
     */
    public function delete(array $condition): bool;

    /**
     * 按ID软删除数据
     */
    public function softDeleteById(mixed $id): bool;

    /**
     * 按条件软删除数据
     */
    public function softDeleteByWhere(array $condition): bool;
}
