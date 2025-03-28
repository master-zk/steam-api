<?php

declare(strict_types=1);

namespace Flame\Session;

use Flame\Session\Contracts\SessionHandlerInterface;
use Flame\Support\Arr;

class Store
{
    /**
     * Session数据
     */
    protected array $data = [];

    /**
     * 是否初始化
     */
    protected ?bool $init = null;

    /**
     * 记录Session ID
     */
    protected string $id;

    protected array $serialize = [];

    public function __construct(protected string $name, protected SessionHandlerInterface $handler, ?array $serialize = null)
    {
        if (! empty($serialize)) {
            $this->serialize = $serialize;
        }

        $this->setId();
    }

    /**
     * 设置数据
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * session初始化
     */
    public function init(): void
    {
        // 读取缓存数据
        $data = $this->handler->read($this->getId());

        if (! empty($data)) {
            $this->data = array_merge($this->data, $this->unserialize($data));
        }

        $this->init = true;
    }

    /**
     * 设置SessionName
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * 获取sessionName
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * session_id设置
     */
    public function setId(?string $id = null): void
    {
        $this->id = is_string($id) && strlen($id) === 32 && ctype_alnum($id) ? $id : md5(microtime(true).session_create_id());
    }

    /**
     * 获取session_id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * 获取所有数据
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * session设置
     */
    public function set(string $name, $value): void
    {
        Arr::set($this->data, $name, $value);
    }

    /**
     * session获取
     */
    public function get(string $name, $default = null)
    {
        return Arr::get($this->data, $name, $default);
    }

    /**
     * session获取并删除
     */
    public function pull(string $name)
    {
        return Arr::pull($this->data, $name);
    }

    /**
     * 添加数据到一个session数组
     */
    public function push(string $key, $value): void
    {
        $array = $this->get($key, []);

        $array[] = $value;

        $this->set($key, $array);
    }

    /**
     * 判断session数据
     */
    public function has(string $name): bool
    {
        return Arr::has($this->data, $name);
    }

    /**
     * 删除session数据
     */
    public function delete(string $name): void
    {
        Arr::forget($this->data, $name);
    }

    /**
     * 清空session数据
     */
    public function clear(): void
    {
        $this->data = [];
    }

    /**
     * 销毁session
     */
    public function destroy(): void
    {
        $this->clear();

        $this->regenerate(true);
    }

    /**
     * 重新生成session id
     */
    public function regenerate(bool $destroy = false): void
    {
        if ($destroy) {
            $this->handler->delete($this->getId());
        }

        $this->setId();
    }

    /**
     * 保存session数据
     */
    public function save(): void
    {
        $this->clearFlashData();

        $sessionId = $this->getId();

        if (! empty($this->data)) {
            $data = $this->serialize($this->data);

            $this->handler->write($sessionId, $data);
        } else {
            $this->handler->delete($sessionId);
        }

        $this->init = false;
    }

    /**
     * session设置 下一次请求有效
     */
    public function flash(string $name, $value): void
    {
        $this->set($name, $value);
        $this->push('__flash__.__next__', $name);
        $this->set('__flash__.__current__', Arr::except($this->get('__flash__.__current__', []), $name));
    }

    /**
     * 将本次闪存数据推迟到下次请求
     */
    public function reflash(): void
    {
        $keys = $this->get('__flash__.__current__', []);
        $values = array_unique(array_merge($this->get('__flash__.__next__', []), $keys));
        $this->set('__flash__.__next__', $values);
        $this->set('__flash__.__current__', []);
    }

    /**
     * 清空当前请求的session数据
     */
    public function clearFlashData(): void
    {
        Arr::forget($this->data, $this->get('__flash__.__current__', []));
        if (! empty($next = $this->get('__flash__.__next__', []))) {
            $this->set('__flash__.__current__', $next);
        } else {
            $this->delete('__flash__.__current__');
        }
        $this->delete('__flash__.__next__');
    }

    /**
     * 序列化数据
     */
    protected function serialize($data): string
    {
        $serialize = $this->serialize[0] ?? 'serialize';

        return $serialize($data);
    }

    /**
     * 反序列化数据
     */
    protected function unserialize(string $data): array
    {
        $unserialize = $this->serialize[1] ?? 'unserialize';

        return (array) $unserialize($data);
    }
}
