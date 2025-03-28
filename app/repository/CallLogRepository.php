<?php

declare(strict_types=1);

namespace app\repository;

use app\entity\CallLogEntity;
use Exception;
use Flame\Database\Contracts\RepositoryInterface;
use Flame\Database\Model;
use Flame\Database\Repositories\CurdRepository;

class CallLogRepository extends CurdRepository implements RepositoryInterface
{
    private static ?CallLogRepository $instance = null;

    /**
     * 单例
     */
    public static function getInstance(): CallLogRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new CallLogRepository();
        }

        return self::$instance;
    }

    /**
     * 添加
     */
    public function createByInput(CallLogEntity $entity): int
    {
        return $this->create($entity->toArray());
    }

    /**
     * 按照ID查询返回对象
     */
    public function findOneByIdReturnCallLogOutput(int $id): ?CallLogEntity
    {
        $data = $this->findOneById($id);
        if (empty($data)) {
            return null;
        }

        $entity = new CallLogEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 按照条件查询
     */
    public function findOneByWhereReturnCallLogOutput(array $condition): ?CallLogEntity
    {
        $data = $this->findOneByWhere($condition);
        if (empty($data)) {
            return null;
        }

        $entity = new CallLogEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 查询列表
     *
     * @throws Exception
     */
    public function findAllReturnCallLogOutput(array $condition = []): array
    {
        $result = $this->findAll($condition);
        if (empty($result)) {
            return [];
        }

        foreach ($result as $key => $item) {
            $entity = new CallLogEntity();
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
    public function paginateReturnCallLogOutput(array $condition, int $page, int $pageSize): array
    {
        $result = $this->paginate($condition, $page, $pageSize);

        foreach ($result['data'] as $key => $item) {
            $entity = new CallLogEntity();
            $entity->setData($item);
            $result['data'][$key] = $entity;
        }

        return $result;
    }

    /**
     * 定义数据数据模型类
     */
    public function model(string $modelName = 'CallLog'): Model
    {
        $model = '\\app\\model\\'.$modelName.'Model';

        return new $model();
    }
}
