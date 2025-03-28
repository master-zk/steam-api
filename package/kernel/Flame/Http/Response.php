<?php

declare(strict_types=1);

namespace Flame\Http;

use Flame\Config\Config;
use Flame\Cookie\Cookie;
use Flame\Session\SessionManager;
use Flame\Support\Facade\Session;
use Flame\Support\Str;
use InvalidArgumentException;

abstract class Response
{
    /**
     * 原始数据
     */
    protected mixed $data;

    /**
     * 当前contentType
     */
    protected string $contentType = 'text/html';

    /**
     * 字符集
     */
    protected string $charset = 'utf-8';

    /**
     * 状态码
     */
    protected int $code = 200;

    /**
     * 是否允许请求缓存
     */
    protected bool $allowCache = true;

    /**
     * 输出参数
     */
    protected array $options = [];

    /**
     * header参数
     */
    protected array $header = [];

    /**
     * 输出内容
     */
    protected ?string $content = null;

    /**
     * Cookie对象
     */
    protected ?Cookie $cookie = null;

    /**
     * Session对象
     */
    protected SessionManager $session;

    /**
     * 初始化
     */
    protected function init($data = '', int $code = 200): void
    {
        $this->data($data);
        $this->code = $code;

        $this->contentType($this->contentType, $this->charset);
    }

    /**
     * 创建Response对象
     */
    public static function create($data = '', string $type = 'html', int $code = 200): Response
    {
        $class = str_contains($type, '\\') ? $type : '\\Flame\\Response\\'.Str::studly($type);

        return new $class($data, $code);
    }

    /**
     * 设置Session对象
     */
    public function setSession(SessionManager $session): static
    {
        $this->session = $session;

        return $this;
    }

    /**
     * 发送数据到客户端
     */
    public function send(): void
    {
        // 处理输出数据
        $data = $this->getContent();

        if (! headers_sent()) {
            if (! empty($this->header)) {
                // 发送状态码
                http_response_code($this->code);
                // 发送头部信息
                foreach ($this->header as $name => $val) {
                    header($name.(! is_null($val) ? ':'.$val : ''));
                }
            }

            $this->cookie?->save();
        }

        $this->sendData($data);

        if (function_exists('fastcgi_finish_request')) {
            // 提高页面响应
            fastcgi_finish_request();
        }

        if (Config::get('session')) {
            Session::getInstance()->save();
        }
    }

    /**
     * 处理数据
     */
    protected function output($data)
    {
        return $data;
    }

    /**
     * 输出数据
     */
    protected function sendData(string $data): void
    {
        echo $data;
    }

    /**
     * 输出的参数
     */
    public function options(array $options = []): static
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * 输出数据设置
     */
    public function data($data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * 是否允许请求缓存
     */
    public function allowCache(bool $cache): static
    {
        $this->allowCache = $cache;

        return $this;
    }

    /**
     * 是否允许请求缓存
     */
    public function isAllowCache(): bool
    {
        return $this->allowCache;
    }

    /**
     * 设置Cookie
     */
    public function cookie(string $name, string $value, $option = null): static
    {
        $this->cookie->set($name, $value, $option);

        return $this;
    }

    /**
     * 设置响应头
     */
    public function header(array $header = []): static
    {
        $this->header = array_merge($this->header, $header);

        return $this;
    }

    /**
     * 设置页面输出内容
     */
    public function content($content): static
    {
        if ($content !== null && ! is_string($content) && ! is_numeric($content) && ! is_callable([
            $content,
            '__toString',
        ])
        ) {
            throw new InvalidArgumentException(sprintf('variable type error： %s', gettype($content)));
        }

        $this->content = (string) $content;

        return $this;
    }

    /**
     * 发送HTTP状态
     */
    public function code(int $code): static
    {
        $this->code = $code;

        return $this;
    }

    /**
     * LastModified
     */
    public function lastModified(string $time): static
    {
        $this->header['Last-Modified'] = $time;

        return $this;
    }

    /**
     * Expires
     */
    public function expires(string $time): static
    {
        $this->header['Expires'] = $time;

        return $this;
    }

    /**
     * ETag
     */
    public function eTag(string $eTag): static
    {
        $this->header['ETag'] = $eTag;

        return $this;
    }

    /**
     * 页面缓存控制
     */
    public function cacheControl(string $cache): static
    {
        $this->header['Cache-control'] = $cache;

        return $this;
    }

    /**
     * 页面输出类型
     */
    public function contentType(string $contentType, string $charset = 'utf-8'): static
    {
        $this->header['Content-Type'] = $contentType.'; charset='.$charset;

        return $this;
    }

    /**
     * 获取头部信息
     */
    public function getHeader(string $name = '')
    {
        if (! empty($name)) {
            return $this->header[$name] ?? null;
        }

        return $this->header;
    }

    /**
     * 获取原始数据
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * 获取输出数据
     */
    public function getContent(): string
    {
        if ($this->content == null) {
            $content = $this->output($this->data);

            if ($content !== null && ! is_string($content) && ! is_numeric($content) && ! is_callable([
                $content,
                '__toString',
            ])
            ) {
                throw new InvalidArgumentException(sprintf('variable type error： %s', gettype($content)));
            }

            $this->content = (string) $content;
        }

        return $this->content;
    }

    /**
     * 获取状态码
     */
    public function getCode(): int
    {
        return $this->code;
    }
}
