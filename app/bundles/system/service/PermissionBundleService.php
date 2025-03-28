<?php

declare(strict_types=1);

namespace app\bundles\system\service;

use app\entity\PermissionEntity;
use Exception;
use Flame\Support\Facade\DB;
use Flame\Support\Str;
use ReflectionClass;
use ReflectionMethod;

class PermissionBundleService
{
    /**
     * @throws Exception
     */
    public function collection(string $module): void
    {
        $files = array_merge(
            glob(app_path('api/'.$module.'/controller/*Controller.php')),
            glob(app_path('bundles/*/controller/'.$module.'/*Controller.php'))
        );
        $permissions = [];
        foreach ($files as $file) {
            $file = str_replace('/', '\\', $file);
            $class = Str::substr($file, stripos($file, 'app\\'), -4);

            $rc = new ReflectionClass($class);
            $methods = $rc->getMethods(ReflectionMethod::IS_PUBLIC);
            foreach ($methods as $method) {
                if ($method->class === $class) {
                    if (Str::substr($method->name, 0, 2) === '__') {
                        // 跳过魔术方法
                        continue;
                    }

                    $name = '';
                    foreach ($method->getAttributes() as $attribute) {
                        $args = $attribute->getArguments();
                        $name = $args['summary'] ?? ''; // 获取接口的描述
                        break; // 仅需处理接口概要（默认第一个注解）
                    }

                    preg_match('/\\\\(\w+)controller/i', $method->class, $controller);

                    if (Str::contains($file, 'bundles')) {
                        preg_match('/app\\\\bundles\\\\(\w+)\\\\controller/i', $file, $matches);
                        $rule = implode('/', [$matches[1], $module, Str::camel($controller[1]), Str::camel($method->name)]);
                    } else {
                        $rule = implode('/', [$module, Str::camel($controller[1]), Str::camel($method->name)]);
                    }

                    $permissions[] = [
                        'module' => $module,
                        'name' => $name,
                        'rule' => $module.'::'.$rule,
                    ];
                }
            }
        }

        $this->batchSavePermission($permissions);
    }

    /**
     * @throws Exception
     */
    public function batchSavePermission(array $data): array
    {
        foreach ($data as $item) {
            $result = DB::table('permission')
                ->where('rule', '=', $item['rule'])
                ->find();
            if (empty($result)) {
                $ruleArr = explode('/', $item['rule']);
                $method = $ruleArr[max(count($ruleArr) - 1, 0)];
                if (in_array($method, ['option', 'queryOption', 'updateOption'])) {
                    continue;
                }
                $except = $this->getExceptPermission();
                if (in_array($item['rule'], $except)) {
                    continue;
                }
                /*$permission = new PermissionEntity;
                $permission->setModule($item['module']);
                $permission->setName($item['name']);
                $permission->setIcon('');
                $permission->setRule($item['rule']);
                $permission->setStatus(1);
                dump($permission->toArray());*/
            }
        }

        return $data;
    }

    public function getExceptPermission(): array
    {
        return [
            'employee::auth/employee/login/captcha',
            'employee::auth/employee/login/mobile',
            'employee::manage/employee/user/logout',
            'employee::manage/employee/user/manager',
            'employee::manage/employee/permission/list',
            'employee::manage/employee/permission/tree',
            'employee::manage/employee/workbench/sipInfo',
            'employee::manage/employee/workbench/callOption',
            'employee::manage/employee/workbench/reportStatus',
            'employee::manage/employee/workbench/statusStat',
            'employee::manage/employee/workbench/reportUserStatus',
            'employee::manage/employee/workbench/userStatusStat',
            'employee::manage/employee/workbench/syncCallLog',
            'employee::manage/employee/blacklist/isVip',
            'employee::manage/employee/callTrace/mobileSelect',
        ];
    }
}
