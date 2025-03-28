<?php

declare(strict_types=1);

namespace app\api\employee\controller;

use app\api\common\controller\BaseController as Controller;
use app\enums\common\StatusEnum;
use app\exception\CustomException;
use app\repository\RoleRepository;
use app\repository\RoleUserRepository;
use app\repository\TenantRepository;
use app\repository\UserRepository;
use app\support\EmployeeContext;
use Flame\Support\Facade\Log;
use Flame\Support\Facade\Request;
use Flame\Support\JWTHelper;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Contact;

#[OA\Info(version: '1.0', description: '提供员工运营管理工具', title: 'JennySteamAPI文档', contact: new Contact('Develop Jenny'))]
#[OA\Server(url: '/', description: '开发环境')]
#[OA\SecurityScheme(securityScheme: 'bearerAuth', type: 'http', description: 'JWT 认证信息', name: 'Authorization', in: 'header', bearerFormat: 'JWT', scheme: 'bearer')]
abstract class BaseController extends Controller
{
    /**
     * 不验证权限的路由
     */
    protected array $except = [];

    /**
     * 需要验证租户的路由
     */
    protected array $internalRoute = [];


    /**
     * 用户ID
     */
    protected int $userId = 0;


    public function __construct()
    {
        // 检查用户、状态
        //$this->checkUser();
        // 设置用户角色
        //$this->setRole();
        // 检查路由权限
        //$this->checkPrivilege();
        // 检查租户
        //$this->checkInternalTenantRoute();
    }

    protected function getUserIdByBearer(): int
    {
        try {
            $body = (new JWTHelper)->getPayloadByBearer();
            if (isset($body['user_id'])) {
                return $body['user_id'];
            }

            throw new CustomException('获取认证信息失败');
        } catch (\Throwable $e) {
            return 0;
        }
    }

    /**
     * 检查用户信息
     */
    protected function checkUser(): void
    {
        $this->userId = $this->getUserIdByBearer();
        // 认证
        if ($this->userId <= 0) {
            $this->fail('请登录后访问', 401)->send();
            exit();
        }

        // 检查用户状态
        $user = UserRepository::getInstance()->findOneByIdReturnUserOutput($this->userId);
        if (empty($user)) {
            $this->fail('账户已注销', 401)->send();
            exit();
        } elseif ($user->getStatus() != StatusEnum::Enabled->value) {
            $this->fail('账户状态异常', 401)->send();
            exit();
        } elseif ($user->getLastLoginToken() != Request::bearerToken()) {
            if (empty($user->getLastLoginToken())) {
                $this->fail('已退出登录', 401)->send();
            } else {
                $this->fail('已在其他设备登录', 401)->send();
            }
            exit();
        } elseif ($user->getTenantId() == 0) {
            $this->fail('未分配租户', 401)->send();
            exit();
        }
        EmployeeContext::setUser($user);

        $tenant = TenantRepository::getInstance()->findOneByIdReturnTenantOutput($user->getTenantId());
        if (empty($tenant)) {
            $this->fail('租户不可用', 401)->send();
            exit();
        }
        EmployeeContext::setTenant($tenant);

    }

    protected function checkPrivilege(): void
    {
        // 是否存在不需要验证的方法，* 表示全部不验证
        if (count(array_uintersect(['*', ACTION_NAME], $this->except, 'strcasecmp')) > 0) {
            return;
        }

        // 管理员不验证
        if (EmployeeContext::getIsAdmin()) {
            return;
        }
    }

    protected function checkInternalTenantRoute(): void
    {
        // 有交集表示需要验证，`*`表示此控制器下全部都需要验证
        if (count(array_uintersect(['*', ACTION_NAME], $this->internalRoute, 'strcasecmp')) == 0) {
            Log::info(ACTION_NAME . ':不需要验证租户');
            return;
        }

        // 验证内部租户
        if (EmployeeContext::getIsInternal()) {
            Log::info(ACTION_NAME . ':内部租户，验证通过');
            return;
        }

        $this->fail('租户无权访问', 400)->send();
        exit();
    }

    /**
     * 检查超级管理员
     */
    protected function setRole(): void
    {
        $roleIds = RoleUserRepository::getInstance()->model()
            ->where('user_id', $this->userId)
            ->column('role_id');
        if (count($roleIds) > 0) {
            $roles = RoleRepository::getInstance()->findAllReturnRoleOutput([
                'id' => $roleIds,
            ]);
            EmployeeContext::setRoles($roles);
        }
    }

    /**
     * 检查用户权限
     */
    protected function hasRole(string $roleName): bool
    {
        foreach (EmployeeContext::getRoles() as $role) {
            if ($role->getName() == $roleName) {
                return true;
            }
        }

        return false;
    }
}
