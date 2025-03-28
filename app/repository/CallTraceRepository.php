<?php

declare(strict_types=1);

namespace app\repository;

use app\entity\CallTraceEntity;
use Exception;
use Flame\Database\Contracts\RepositoryInterface;
use Flame\Database\Model;
use Flame\Database\Repositories\CurdRepository;

class CallTraceRepository extends CurdRepository implements RepositoryInterface
{
    private static ?CallTraceRepository $instance = null;

    /**
     * 单例
     */
    public static function getInstance(): CallTraceRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new CallTraceRepository();
        }

        return self::$instance;
    }

    /**
     * 添加
     */
    public function createByInput(CallTraceEntity $entity): int
    {
        return $this->create($entity->toArray());
    }

    /**
     * 按照ID查询返回对象
     */
    public function findOneByIdReturnCallTraceOutput(int $id): ?CallTraceEntity
    {
        $data = $this->findOneById($id);
        if (empty($data)) {
            return null;
        }

        $entity = new CallTraceEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 按照条件查询
     */
    public function findOneByWhereReturnCallTraceOutput(array $condition): ?CallTraceEntity
    {
        $data = $this->findOneByWhere($condition);
        if (empty($data)) {
            return null;
        }

        $entity = new CallTraceEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 查询列表
     *
     * @throws Exception
     */
    public function findAllReturnCallTraceOutput(array $condition = []): array
    {
        $result = $this->findAll($condition);
        if (empty($result)) {
            return [];
        }

        foreach ($result as $key => $item) {
            $entity = new CallTraceEntity();
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
    public function paginateReturnCallTraceOutput(array $condition, int $page, int $pageSize): array
    {
        $result = $this->paginate($condition, $page, $pageSize);

        foreach ($result['data'] as $key => $item) {
            $entity = new CallTraceEntity();
            $entity->setData($item);
            $result['data'][$key] = $entity;
        }

        return $result;
    }

    /**
     * 定义数据数据模型类
     */
    public function model(string $modelName = 'CallTrace'): Model
    {
        $model = '\\app\\model\\'.$modelName.'Model';

        return new $model();
    }
}
