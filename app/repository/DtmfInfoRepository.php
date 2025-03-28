<?php

declare(strict_types=1);

namespace app\repository;

use app\entity\DtmfInfoEntity;
use Exception;
use Flame\Database\Contracts\RepositoryInterface;
use Flame\Database\Model;
use Flame\Database\Repositories\CurdRepository;

class DtmfInfoRepository extends CurdRepository implements RepositoryInterface
{
    private static ?DtmfInfoRepository $instance = null;

    /**
     * 单例
     */
    public static function getInstance(): DtmfInfoRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new DtmfInfoRepository();
        }

        return self::$instance;
    }

    /**
     * 添加
     */
    public function createByInput(DtmfInfoEntity $entity): string
    {
        return $this->create($entity->toArray());
    }

    /**
     * 按照ID查询返回对象
     */
    public function findOneByIdReturnDtmfInfoOutput(string $id): ?DtmfInfoEntity
    {
        $data = $this->findOneById($id);
        if (empty($data)) {
            return null;
        }

        $entity = new DtmfInfoEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 按照条件查询
     */
    public function findOneByWhereReturnDtmfInfoOutput(array $condition): ?DtmfInfoEntity
    {
        $data = $this->findOneByWhere($condition);
        if (empty($data)) {
            return null;
        }

        $entity = new DtmfInfoEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 查询列表
     *
     * @throws Exception
     */
    public function findAllReturnDtmfInfoOutput(array $condition = []): array
    {
        $result = $this->findAll($condition);
        if (empty($result)) {
            return [];
        }

        foreach ($result as $key => $item) {
            $entity = new DtmfInfoEntity();
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
    public function paginateReturnDtmfInfoOutput(array $condition, int $page, int $pageSize): array
    {
        $result = $this->paginate($condition, $page, $pageSize);

        foreach ($result['data'] as $key => $item) {
            $entity = new DtmfInfoEntity();
            $entity->setData($item);
            $result['data'][$key] = $entity;
        }

        return $result;
    }

    /**
     * 定义数据数据模型类
     */
    public function model(string $modelName = 'DtmfInfo'): Model
    {
        $model = '\\app\\model\\'.$modelName.'Model';

        return new $model();
    }
}
