<?php

declare(strict_types=1);

namespace app\repository;

use app\entity\CallTransferNumberGroupNumberEntity;
use Exception;
use Flame\Database\Contracts\RepositoryInterface;
use Flame\Database\Model;
use Flame\Database\Repositories\CurdRepository;

class CallTransferNumberGroupNumberRepository extends CurdRepository implements RepositoryInterface
{
    private static ?CallTransferNumberGroupNumberRepository $instance = null;

    /**
     * 单例
     */
    public static function getInstance(): CallTransferNumberGroupNumberRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new CallTransferNumberGroupNumberRepository();
        }

        return self::$instance;
    }

    /**
     * 添加
     */
    public function createByInput(CallTransferNumberGroupNumberEntity $entity): int
    {
        return $this->create($entity->toArray());
    }

    /**
     * 按照ID查询返回对象
     */
    public function findOneByIdReturnCallTransferNumberGroupNumberOutput(int $id): ?CallTransferNumberGroupNumberEntity
    {
        $data = $this->findOneById($id);
        if (empty($data)) {
            return null;
        }

        $entity = new CallTransferNumberGroupNumberEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 按照条件查询
     */
    public function findOneByWhereReturnCallTransferNumberGroupNumberOutput(array $condition): ?CallTransferNumberGroupNumberEntity
    {
        $data = $this->findOneByWhere($condition);
        if (empty($data)) {
            return null;
        }

        $entity = new CallTransferNumberGroupNumberEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 查询列表
     *
     * @throws Exception
     */
    public function findAllReturnCallTransferNumberGroupNumberOutput(array $condition = []): array
    {
        $result = $this->findAll($condition);
        if (empty($result)) {
            return [];
        }

        foreach ($result as $key => $item) {
            $entity = new CallTransferNumberGroupNumberEntity();
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
    public function paginateReturnCallTransferNumberGroupNumberOutput(array $condition, int $page, int $pageSize): array
    {
        $result = $this->paginate($condition, $page, $pageSize);

        foreach ($result['data'] as $key => $item) {
            $entity = new CallTransferNumberGroupNumberEntity();
            $entity->setData($item);
            $result['data'][$key] = $entity;
        }

        return $result;
    }

    /**
     * 定义数据数据模型类
     */
    public function model(string $modelName = 'CallTransferNumberGroupNumber'): Model
    {
        $model = '\\app\\model\\'.$modelName.'Model';

        return new $model();
    }
}
