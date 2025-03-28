<?php

declare(strict_types=1);

namespace Flame\Foundation;

use Exception;
use Flame\Config\Config;
use Flame\Http\Response;
use Flame\Routing\Route;
use Flame\Session\SessionManager;
use Flame\Support\Facade\DB;
use Flame\Support\Facade\Log;
use Flame\Support\Facade\RateLimiter;
use Flame\Support\Facade\Request;
use Flame\Support\Facade\Session;
use Flame\Support\Str;
use Throwable;

/**
 * 应用启动
 */
class App
{
    /**
     * 初始化配置
     */
    protected static function init(): void
    {
        Config::init();

        if (Config::get('app.debug')) {
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            set_error_handler(function ($errno, $errStr, $errFile, $errLine) {
                $backtrace = debug_backtrace();
                $traces = [];
                foreach ($backtrace as $i => $trace) {
                    $item = "#$i: ";
                    if (isset($trace['file'])) {
                        $item .= $trace['file'].' ('.$trace['line'].'): ';
                    }
                    if (isset($trace['class'])) {
                        $item .= $trace['class'].$trace['type'].$trace['function'];
                    } else {
                        $item .= $trace['function'];
                    }
                    $traces[] = $item;
                }
                $message = "$errStr in $errFile on line $errLine";
                Response::create(['code' => 500, 'message' => $message, 'data' => $traces], 'json', 500)->send();
                Log::error($message);
                exit();
            });
        } else {
            ini_set('display_errors', 0);
            error_reporting(0);
        }

        // self::rateLimiter();

        if (Config::get('session')) {
            self::sessionStart();
        }

        Request::init();

        DB::setConfig(Config::get('database'));
    }

    /**
     * 运行框架
     */
    public static function run(): void
    {
        try {
            self::init();

            Hook::init();
            Hook::listen('appBegin');

            Hook::listen('routeParseUrl', [Config::get('route.rewrite_rule'), Config::get('route.rewrite_on')]);

            // 加载路由配置
            $routeFile = base_path('routes/api.php');
            if (file_exists($routeFile)) {
                $routes = require $routeFile;
            } else {
                $routes = [];
            }

            $currentPath = Str::lower(Request::path());
            $currentPath = empty($currentPath) ? '/' : '/'.ltrim($currentPath, '/');
            if (isset($routes[$currentPath])) {
                [$controller, $action] = $routes[$currentPath];
            } else {
                // 路由解析
                if (! defined('APP_NAME') || ! defined('MODULE_NAME') || ! defined('CONTROLLER_NAME') || ! defined('ACTION_NAME')) {
                    Route::parseUrl(Config::get('route.rewrite_rule'), Config::get('route.rewrite_on'));
                }

                // 路由对象
                $controller = '\\app\\api\\'.APP_NAME.'\\controller\\'.Str::studly(MODULE_NAME).'Controller';
                $controller2 = '\\app\\bundles\\'.APP_NAME.'\\controller\\'.MODULE_NAME.'\\'.CONTROLLER_NAME.'Controller';

                $action = 'index';
                if (class_exists($controller)) {
                    $action = Str::camel(CONTROLLER_NAME);
                } elseif (class_exists($controller2)) {
                    $controller = $controller2;
                    $action = ACTION_NAME;
                }
            }

            if (! isset($controller)) {
                throw new Exception("controller '{$controller}' not found", 404);
            }

            $obj = new $controller;
            if (! method_exists($obj, $action)) {
                throw new Exception("Action '{$controller}::{$action}()' not found", 404);
            }

            Hook::listen('actionBefore', [$obj, $action]);
            $response = $obj->$action();
            Hook::listen('actionAfter', [$obj, $action]);

            if ($response instanceof Response) {
                $response->send();
            } else {
                echo $response;
            }
        } catch (Throwable $e) {
            Log::error($e);

            Hook::listen('appError', [$e]);
        }

        Hook::listen('appEnd');
    }

    /**
     * Session 启动器
     */
    public static function sessionStart(): void
    {
        /** @var SessionManager $session */
        $session = Session::getInstance();

        $config = $session->getConfig();
        $varSessionId = $config['var_session_id'];
        if ($varSessionId && Request::get($varSessionId)) {
            $sessionId = Request::get($varSessionId);
        } else {
            $cookieName = $session->getName();
            $sessionId = cookie($cookieName);
        }

        if ($sessionId) {
            $session->setId($sessionId);
        }

        $session->init();

        cookie($session->getName(), $session->getId(), $config['expire']);
    }

    /**
     * 限流器
     */
    public static function rateLimiter(int $maxAttempts = 600): void
    {
        $ip = Request::ip();
        if (RateLimiter::tooManyAttempts('request-ip:'.$ip, $maxAttempts)) {
            // Too many attempts!
            $message = '请求太频繁，请稍后再试。';
            Response::create(['code' => 429, 'message' => $message, 'data' => []], 'json', 429)->send();
            Log::error($ip.$message);
            exit();
        }

        RateLimiter::hit('request-ip:'.$ip);
    }
}
