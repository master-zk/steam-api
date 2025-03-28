<?php

declare(strict_types=1);

namespace app\repository;

use app\entity\CallTransferNumberGroupEntity;
use Exception;
use Flame\Database\Contracts\RepositoryInterface;
use Flame\Database\Model;
use Flame\Database\Repositories\CurdRepository;

class CallTransferNumberGroupRepository extends CurdRepository implements RepositoryInterface
{
    private static ?CallTransferNumberGroupRepository $instance = null;

    /**
     * 单例
     */
    public static function getInstance(): CallTransferNumberGroupRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new CallTransferNumberGroupRepository();
        }

        return self::$instance;
    }

    /**
     * 添加
     */
    public function createByInput(CallTransferNumberGroupEntity $entity): int
    {
        return $this->create($entity->toArray());
    }

    /**
     * 按照ID查询返回对象
     */
    public function findOneByIdReturnCallTransferNumberGroupOutput(int $id): ?CallTransferNumberGroupEntity
    {
        $data = $this->findOneById($id);
        if (empty($data)) {
            return null;
        }

        $entity = new CallTransferNumberGroupEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 按照条件查询
     */
    public function findOneByWhereReturnCallTransferNumberGroupOutput(array $condition): ?CallTransferNumberGroupEntity
    {
        $data = $this->findOneByWhere($condition);
        if (empty($data)) {
            return null;
        }

        $entity = new CallTransferNumberGroupEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 查询列表
     *
     * @throws Exception
     */
    public function findAllReturnCallTransferNumberGroupOutput(array $condition = []): array
    {
        $result = $this->findAll($condition);
        if (empty($result)) {
            return [];
        }

        foreach ($result as $key => $item) {
            $entity = new CallTransferNumberGroupEntity();
            $entity->setData($item);
            $result[$key] = $entity;
        }

        return $result;
    }

    /**
     * 分页查询
     *
     * @throws Exception
     */
    public function paginateReturnCallTransferNumberGroupOutput(array $condition, int $page, int $pageSize): array
    {
        $result = $this->paginate($condition, $page, $pageSize);

        foreach ($result['data'] as $key => $item) {
            $entity = new CallTransferNumberGroupEntity();
            $entity->setData($item);
            $result['data'][$key] = $entity;
        }

        return $result;
    }

    /**
     * 定义数据数据模型类
     */
    public function model(string $modelName = 'CallTransferNumberGroup'): Model
    {
        $model = '\\app\\model\\'.$modelName.'Model';

        return new $model();
    }
}
