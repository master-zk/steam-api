<?php

declare(strict_types=1);

namespace app\repository;

use app\entity\SmsSendBatchEntity;
use Exception;
use Flame\Database\Contracts\RepositoryInterface;
use Flame\Database\Model;
use Flame\Database\Repositories\CurdRepository;

class SmsSendBatchRepository extends CurdRepository implements RepositoryInterface
{
    private static ?SmsSendBatchRepository $instance = null;

    /**
     * 单例
     */
    public static function getInstance(): SmsSendBatchRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new SmsSendBatchRepository();
        }

        return self::$instance;
    }

    /**
     * 添加
     */
    public function createByInput(SmsSendBatchEntity $entity): int
    {
        return $this->create($entity->toArray());
    }

    /**
     * 按照ID查询返回对象
     */
    public function findOneByIdReturnSmsSendBatchOutput(int $id): ?SmsSendBatchEntity
    {
        $data = $this->findOneById($id);
        if (empty($data)) {
            return null;
        }

        $entity = new SmsSendBatchEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 按照条件查询
     */
    public function findOneByWhereReturnSmsSendBatchOutput(array $condition): ?SmsSendBatchEntity
    {
        $data = $this->findOneByWhere($condition);
        if (empty($data)) {
            return null;
        }

        $entity = new SmsSendBatchEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 查询列表
     *
     * @throws Exception
     */
    public function findAllReturnSmsSendBatchOutput(array $condition = []): array
    {
        $result = $this->findAll($condition);
        if (empty($result)) {
            return [];
        }

        foreach ($result as $key => $item) {
            $entity = new SmsSendBatchEntity();
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
    public function paginateReturnSmsSendBatchOutput(array $condition, int $page, int $pageSize): array
    {
        $result = $this->paginate($condition, $page, $pageSize);

        foreach ($result['data'] as $key => $item) {
            $entity = new SmsSendBatchEntity();
            $entity->setData($item);
            $result['data'][$key] = $entity;
        }

        return $result;
    }

    /**
     * 定义数据数据模型类
     */
    public function model(string $modelName = 'SmsSendBatch'): Model
    {
        $model = '\\app\\model\\'.$modelName.'Model';

        return new $model();
    }
}
