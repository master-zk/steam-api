<?php

declare(strict_types=1);

namespace app\support;

use app\entity\RoleEntity;
use app\entity\TenantEntity;
use app\entity\UserEntity;
use app\enums\common\IsEnum;

final class EmployeeContext
{
    private function __construct() {}

    private function __clone() {}

    private static bool $isAdmin = false;

    private static bool $isInternal = false;

    private static int $userId = 0;

    private static int $tenantId = 0;

    private static ?TenantEntity $tenant = null;

    private static ?UserEntity $user = null;

    /** @var RoleEntity[] */
    private static array $roles = [];

    private static bool $userLock = false;

    private static bool $tenantLock = false;

    private static bool $roleLock = false;

    public static function setUser(UserEntity $value): void
    {
        if (self::$userLock) {
            throw new \Exception('已设置过全局用户信息');
        }

        self::$user = $value;
        self::$userId = $value->getId();
        self::$userLock = true;
    }

    public static function setTenant(TenantEntity $value): void
    {
        if (self::$tenantLock) {
            throw new \Exception('已设置过全局租户信息');
        }

        self::$tenant = $value;
        self::$tenantId = $value->getId();
        self::$isInternal = $value->getIsInternal() == IsEnum::Yes->value;
        self::$tenantLock = true;
    }

    public static function setRoles(array $value): void
    {
        if (self::$roleLock) {
            throw new \Exception('已设置过全局角色信息');
        }

        if (count($value) > 0) {
            self::$roles = $value;
            foreach (self::$roles as $role) {
                if ($role instanceof RoleEntity) {
                    if ($role->getIsAdmin() == IsEnum::Yes->value) {
                        self::$isAdmin = true;
                    }
                }
            }
        }
        self::$roleLock = true;
    }

    public static function getUser(): UserEntity
    {
        return self::$user;
    }

    public static function getUserId(): int
    {
        return self::$userId;
    }

    public static function getTenant(): TenantEntity
    {
        return self::$tenant;
    }

    public static function getTenantId(): int
    {
        return self::$tenantId;
    }

    public static function getRoles(): array
    {
        return self::$roles;
    }

    public static function getIsInternal(): bool
    {
        return self::$isInternal;
    }

    public static function getIsAdmin(): bool
    {
        return self::$isAdmin;
    }
}
