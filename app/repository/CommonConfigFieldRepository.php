<?php

declare(strict_types=1);

namespace app\repository;

use app\entity\CommonConfigFieldEntity;
use Exception;
use Flame\Database\Contracts\RepositoryInterface;
use Flame\Database\Model;
use Flame\Database\Repositories\CurdRepository;

class CommonConfigFieldRepository extends CurdRepository implements RepositoryInterface
{
    private static ?CommonConfigFieldRepository $instance = null;

    /**
     * 单例
     */
    public static function getInstance(): CommonConfigFieldRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new CommonConfigFieldRepository();
        }

        return self::$instance;
    }

    /**
     * 添加
     */
    public function createByInput(CommonConfigFieldEntity $entity): int
    {
        return $this->create($entity->toArray());
    }

    /**
     * 按照ID查询返回对象
     */
    public function findOneByIdReturnCommonConfigFieldOutput(int $id): ?CommonConfigFieldEntity
    {
        $data = $this->findOneById($id);
        if (empty($data)) {
            return null;
        }

        $entity = new CommonConfigFieldEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 按照条件查询
     */
    public function findOneByWhereReturnCommonConfigFieldOutput(array $condition): ?CommonConfigFieldEntity
    {
        $data = $this->findOneByWhere($condition);
        if (empty($data)) {
            return null;
        }

        $entity = new CommonConfigFieldEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 查询列表
     *
     * @throws Exception
     */
    public function findAllReturnCommonConfigFieldOutput(array $condition = []): array
    {
        $result = $this->findAll($condition);
        if (empty($result)) {
            return [];
        }

        foreach ($result as $key => $item) {
            $entity = new CommonConfigFieldEntity();
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
    public function paginateReturnCommonConfigFieldOutput(array $condition, int $page, int $pageSize): array
    {
        $result = $this->paginate($condition, $page, $pageSize);

        foreach ($result['data'] as $key => $item) {
            $entity = new CommonConfigFieldEntity();
            $entity->setData($item);
            $result['data'][$key] = $entity;
        }

        return $result;
    }

    /**
     * 定义数据数据模型类
     */
    public function model(string $modelName = 'CommonConfigField'): Model
    {
        $model = '\\app\\model\\'.$modelName.'Model';

        return new $model();
    }
}
