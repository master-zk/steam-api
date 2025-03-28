<?php

declare(strict_types=1);

namespace Flame\Routing;

use Exception;
use Flame\Foundation\Contract\EnumMethodInterface;
use Flame\Http\Response;
use Flame\Support\Facade\Request;
use Throwable;

/**
 * 公共控制器
 */
abstract class Controller
{
    /**
     * 获取JSON请求数据
     */
    public function requestBody(bool $raw = false): array|string
    {
        $contents = file_get_contents('php://input');
        if ($raw) {
            return $contents;
        }

        $data = json_decode($contents, true);
        if (in_array(gettype($data), ['boolean', 'NULL'])) {
            return [];
        }

        return $data;
    }

    /**
     * 请求过滤post、get
     */
    public function input($name = null, $default = null)
    {
        static $args;
        if (! $args) {
            $args = array_merge($_GET, $_POST);
        }
        if ($name == null) {
            return $args;
        }
        if (! isset($args[$name])) {
            return $default;
        }
        $arg = $args[$name];
        if (is_array($arg)) {
            array_walk($arg, function (&$v) {
                $v = trim(htmlspecialchars($v, ENT_QUOTES, 'UTF-8'));
            });
        } else {
            $arg = trim(htmlspecialchars($arg, ENT_QUOTES, 'UTF-8'));
        }

        return $arg;
    }

    /**
     * 获取上传的文件信息
     *
     * @throws Exception
     */
    public function file(string $name = '')
    {
        $files = Request::allFiles();
        if (! empty($files)) {
            if (strpos($name, '.')) {
                [$name, $sub] = explode('.', $name);
            }

            if ($name === '') {
                // 获取全部文件
                return $files;
            } elseif (isset($sub) && isset($files[$name][$sub])) {
                return $files[$name][$sub];
            } elseif (isset($files[$name])) {
                return $files[$name];
            }
        }

        return null;
    }

    /**
     * 返回JSON数据
     */
    protected function json(array $data = []): Response
    {
        return Response::create($data, 'json');
    }

    /**
     * 返回成功JSON数据
     */
    protected function success($data = null): Response
    {
        return $this->json([
            'code' => 0,
            'message' => 'ok',
            'data' => $data,
        ]);
    }

    /**
     * 返回失败JSON数据
     */
    protected function fail(Throwable|EnumMethodInterface|string $message = 'fail', $code = 500): Response
    {
        if ($message instanceof Throwable) {
            $code = $message->getCode();
            $message = $message->getMessage();
        } elseif ($message instanceof EnumMethodInterface) {
            $code = $message->getValue();
            $message = $message->getDescription();
        }

        return $this->json([
            'code' => $code,
            'message' => $message,
            'data' => null,
        ]);
    }
}
